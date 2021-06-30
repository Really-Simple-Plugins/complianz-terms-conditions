/**
 * BLOCK:Complianz Documents block
 *
 * Registering the Complianz Privacy Suite documents block with Gutenberg.
 */


import * as api from './block/utils/api';
//
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InspectorControls } = wp.editor;
const { SelectControl } = wp.components;
const { PanelBody, PanelRow } = wp.components;
const { RichText } = wp.editor;
const { Component } = wp.element;
const el = wp.element.createElement;

/**
 *  Set custom Complianz Icon
 */

const iconEl =
    el('svg', { width: 20, height: 20 ,viewBox : "0 0 133.62 133.62"},
        el('path', { d: "M113.63,19.34C100.37,6.51,84.41,0,66.2,0A64.08,64.08,0,0,0,19.36,19.36,64.08,64.08,0,0,0,0,66.2c0,18.25,6.51,34.21,19.34,47.43s28.61,20,46.86,20,34.2-6.72,47.45-20,20-29.21,20-47.45S126.89,32.21,113.63,19.34Zm-2.85,91.44c-12.47,12.46-27.47,18.77-44.58,18.77s-31.89-6.31-43.94-18.75A62.11,62.11,0,0,1,4.07,66.2a60.14,60.14,0,0,1,18.17-44,60.1,60.1,0,0,1,44-18.17c17.12,0,32.12,6.12,44.6,18.19s18.75,26.86,18.75,43.94S123.23,98.32,110.78,110.78Z" } ),
        el('path', { d: "M99.49,30.71a6.6,6.6,0,0,0-9.31,0L40.89,80,35.3,74.41a6.58,6.58,0,0,0-9.31,0l-2.12,2.12a6.6,6.6,0,0,0,0,9.31l9.64,9.64a6.67,6.67,0,0,0,.56.65l2.12,2.12L41,102.8l4-4a8.39,8.39,0,0,0,.65-.56l2.12-2.12a8.39,8.39,0,0,0,.56-.65l53.34-53.34a6.6,6.6,0,0,0,0-9.31Z" } ),
        el('path', { d: "M94.91,86.63H65.15L48.86,102.8H94.91a6.6,6.6,0,0,0,6.58-6.58v-3A6.61,6.61,0,0,0,94.91,86.63Z" } ),
        el('path', { d: "M47.09,45H68.71L85,28.79H47.09a6.6,6.6,0,0,0-6.58,6.58v3A6.6,6.6,0,0,0,47.09,45Z" } ),
    );

class selectDocument extends Component {
    // Method for setting the initial state.
    static getInitialState(attributes) {
        return {
            customDocument: attributes.customDocument,
            documentSyncStatus : attributes.documentSyncStatus,
            document: {},
            preview: false,
        };
    }

    // Constructing our component. With super() we are setting everything to 'this'.
    // Now we can access the attributes with this.props.attributes
    constructor() {
        super(...arguments);
        // Maybe we have a previously selected document. Try to load it.
        this.state = this.constructor.getInitialState(this.props.attributes);
        this.getDocument = this.getDocument.bind(this);
        this.getDocument();

        this.onChangeSelectDocumentSyncStatus = this.onChangeSelectDocumentSyncStatus.bind(this);
        this.onChangeCustomDocument = this.onChangeCustomDocument.bind(this);
    }

    getDocument(args = {}) {
        return (api.getDocument()).then( ( response ) => {
            let document = response.data;
            if( document ) {
                // This is the same as { document: document, documents: documents }
                this.setState( { document } );
            }
        });
    }

    onChangeCustomDocument(value){
        this.setState({customDocument: value});

        // Set the attributes
        this.props.setAttributes({
            customDocument: value,
        });
    }

    onChangeSelectDocumentSyncStatus(value){
        this.setState({documentSyncStatus: value});

        // Set the attributes
        this.props.setAttributes({
            documentSyncStatus: value,
        });

        if (value==='sync'){
            //when sync is turned back on, we reset the customDocument data
            let output = this.state.document.content;

            this.setState({customDocument: output});

            // Set the attributes
            this.props.setAttributes({
                customDocument: output,
            });

        }
    }

    render() {
        const { className, attributes: {} = {} } = this.props;
        let output = __('Loading...', 'complianz-terms-conditions');
        let id = 'document-title';
        let documentSyncStatus = 'sync';
        let document_status_options = [
            {value: 'sync', label: __('Synchronize document with Complianz', 'complianz-terms-conditions')},
            {value: 'unlink', label: __('Edit document and stop synchronization', 'complianz-terms-conditions')},
        ];

        //preview
        if (this.props.attributes.preview){
            return(
                <img src={complianztc.cmplz_tc_preview} />
            );
        }

        //load content
        if (this.state.document && this.state.document.hasOwnProperty('title')) {
            output = this.state.document.content;
            id = this.props.attributes.selectedDocument;
            documentSyncStatus = this.props.attributes.documentSyncStatus;
        }

        let customDocument = output;
        if (this.props.attributes.customDocument.length>0){
            // customDocument = this.props.attributes.customDocument;
        }

        if (documentSyncStatus==='sync') {
            return [
                !!this.props.isSelected && (
                    <InspectorControls key='inspector'>
                        <PanelBody title={ __('Document settings', 'complianz-terms-conditions' ) }initialOpen={ true } >
                            <PanelRow>
                                <SelectControl onChange={this.onChangeSelectDocumentSyncStatus}
                                               value={this.props.attributes.documentSyncStatus}
                                               label={__('Document sync status', 'complianz-terms-conditions')}
                                               options={document_status_options}/>
                            </PanelRow>
                        </PanelBody>
                    </InspectorControls>
                ),

                <div key={id} className={className} dangerouslySetInnerHTML={{__html: output}}></div>
            ]
        } else {
            return [
                !!this.props.isSelected && (
                    <InspectorControls key='inspector'>
                        <PanelBody title={ __('Document settings', 'complianz-terms-conditions' ) }initialOpen={ true } >
                            <PanelRow>
                                <SelectControl onChange={this.onChangeSelectDocumentSyncStatus}
                                               value={this.props.attributes.documentSyncStatus}
                                               label={__('Document sync status', 'complianz-terms-conditions')}
                                               options={document_status_options}/>
                            </PanelRow>
                        </PanelBody>
                    </InspectorControls>
                ),

                <RichText
                    className={className}
                    value={customDocument}
                    autoFocus
                    onChange={this.onChangeCustomDocument}
                />
            ]
        }
    }

}

/**
 * Register: a Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */

registerBlockType('complianztc/terms-conditions', {
    title: __('Legal document - Complianz Terms & conditions', 'complianz-terms-conditions'), // Block title.
    icon: iconEl, // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
    category: 'widgets',
    example: {
        attributes: {
            'preview' : true,
        },
    },
    keywords: [
        __('Terms & conditions', 'complianz-terms-conditions'),
    ],
    //className: 'cmplz-document',
    attributes: {
        documentSyncStatus: {
            type: 'string',
            default: 'sync'
        },
        customDocument: {
            type: 'string',
            default: ''
        },
        content: {
            type: 'string',
            source: 'children',
            selector: 'p',
        },
        document: {
            type: 'array',
        },
        preview: {
            type: 'boolean',
            default: false,
        }
    },
    /**
     * The edit function describes the structure of your block in the context of the editor.
     * This represents what the editor will render when the block is used.
     *
     * The "edit" property must be a valid function.
     *
     * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
     */

    edit:selectDocument,

    /**
     * The save function defines the way in which the different attributes should be combined
     * into the final markup, which is then serialized by Gutenberg into post_content.
     *
     * The "save" property must be specified and must be a valid function.
     *
     * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
     */

    save: function() {
        // Rendering in PHP
        return null;
    },
});
