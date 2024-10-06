import {registerBlockType} from '@wordpress/blocks';
import {InspectorControls, RichText, useBlockProps} from "@wordpress/block-editor";
import {
    PanelBody,
    ToggleControl,
    TextControl
} from '@wordpress/components';
import {__} from "@wordpress/i18n";

registerBlockType(
    'mpt-block/mpt-about-widget', {
        title: 'MPT About Widget',
        icon: 'bell',
        category: 'widgets',
        keywords: ['About', 'mpt', 'About Widget', 'Social Link'],
        attributes: {
            email_id: {
                type: 'string',
                source: 'html',
                selector: 'h6',
            },
            content: {
                type: 'string',
                source: 'html',
                selector: '.wp_block_description',
            },
            showSociallinks: {
                type: 'boolean',
                default: false
            },
            facebook: {
                type: 'string',
                source: 'attribute',
                selector: '.mpt-social-facebook',
                attribute: 'href'
            },

            twitter: {
                type: 'string',
                source: 'attribute',
                selector: '.mpt-social-twitter',
                attribute: 'href'
            },

            instagram: {
                type: 'string',
                source: 'attribute',
                selector: '.mpt-social-instagram',
                attribute: 'href'
            },
            dribbble: {
                type: 'string',
                source: 'attribute',
                selector: '.mpt-social-dribbble',
                attribute: 'href'
            },
            linkedin: {
                type: 'string',
                source: 'attribute',
                selector: '.mpt-social-linkedin',
                attribute: 'href'
            },
        },


        edit: ({attributes, setAttributes}) => {
            const {
                email_id,
                content,
                facebook,
                twitter,
                instagram,
                dribbble,
                linkedin,
                showSociallinks,
            } = attributes;
            return (
                <>
                    <InspectorControls>

                        <PanelBody title={__('Social Links')}>

                            <ToggleControl label={__('Show Social-links')} value={showSociallinks} checked={showSociallinks} onChange={val => setAttributes({ showSociallinks: val })} />

                            {showSociallinks &&
                                <>
                                <TextControl label={__('Facebook')} value={facebook} onChange={val => setAttributes({facebook: val})}/>
                                <TextControl label={__('Twitter')} value={twitter} onChange={val => setAttributes({twitter: val})}/>
                                <TextControl label={__('Instagram')} value={instagram} onChange={val => setAttributes({instagram: val})}/>
                                <TextControl label={__('Dribbble')} value={dribbble} onChange={val => setAttributes({dribbble: val})}/>
                                <TextControl label={__('Linkedin')} value={linkedin} onChange={val => setAttributes({linkedin: val})}/>
                                </>
                            }
                        </PanelBody>
                    </InspectorControls>
                    <div className="mpt_about_widget_block">

                        <div className="saspik_block_email_id_wrap">
                            <i className="ei ei-icon_mail_alt"></i>
                            <RichText
                                key="panel-email-id"
                                className="mpt_about_widget_block"
                                tagName="h6"
                                value={email_id}
                                onChange={(email_id) => setAttributes({email_id})}
                                placeholder="Email Id..."
                            />
                        </div>

                        <RichText
                            key="panel-des"
                            className="wp_block_description"
                            tagName="p"
                            value={content}
                            allowedFormats={['core/bold', 'core/italic']}
                            onChange={(content) => setAttributes({content})}
                            placeholder="Description..."
                        />

                        {showSociallinks && (facebook || twitter || instagram || linkedin || dribbble ) &&

                        <ul className="mpt-block-social-link-wrapper">
                            {facebook &&
                                <li>
                                    <a className="mpt-social-facebook"><i className="fab fa-facebook-f"/></a>
                                </li>
                            }
                            {twitter &&
                                <li>
                                    <a className="mpt-social-twitter"><i className="fab fa-twitter"/></a>
                                </li>
                            }
                            {instagram &&
                                <li>
                                    <a className="mpt-social-instagram"><i className="fab fa-instagram"/></a>
                                </li>
                            }
                            { linkedin &&
                            <li>
                                <a className="mpt-social-linkedin"><i className="fab fa-linkedin"/></a>
                            </li>
                            }
                            {dribbble &&
                                <li>
                                    <a className="mpt-social-dribbble"><i className="fab fa-dribbble"/></a>
                                </li>
                            }
                        </ul>
                        }
                    </div>

                </>
            )
        },

        save: ({attributes}) => {
            const {
                email_id,
                content,
                facebook,
                twitter,
                instagram,
                linkedin,
                dribbble,
                showSociallinks
            } = attributes;
            return (
                <>
                    <div className="mpt_about_widget_block">
                        <div className="saspik_block_email_id_wrap">
                            <i className="ei ei-icon_mail_alt"></i>
                            <h6 className="mpt_about_widget_block">
                                {email_id}
                            </h6>
                        </div>


                        <RichText.Content
                            className="wp_block_description"
                            tagName="p"
                            value={content}
                        />

                        {showSociallinks && (facebook || twitter || instagram || linkedin || dribbble ) &&
                            <ul className="mpt-block-social-link-wrapper">
                                {facebook &&
                                <li>
                                    <a href={facebook} className="mpt-social-facebook" target="_blank" rel="noopener noreferrer"><i className="fab fa-facebook-f"/></a>
                                </li>
                                }
                                {twitter &&
                                <li>
                                    <a href={twitter} className="mpt-social-twitter" target="_blank" rel="noopener noreferrer"><i className="fab fa-twitter"/></a>
                                </li>
                                }
                                {instagram &&
                                <li>
                                    <a href={instagram} className="mpt-social-instagram" target="_blank" rel="noopener noreferrer"><i className="fab fa-instagram"/></a>
                                </li>
                                }
                                { linkedin &&
                                <li>
                                    <a href={linkedin} className="mpt-social-linkedin" target="_blank" rel="noopener noreferrer"><i className="fab fa-linkedin"/></a>
                                </li>
                                }
                                { dribbble &&
                                <li>
                                    <a href={dribbble} className="mpt-social-dribbble" target="_blank" rel="noopener noreferrer"><i className="fab fa-dribbble"/></a>
                                </li>
                                }
                            </ul>
                        }
                    </div>
                </>
            )
        }
    }
);