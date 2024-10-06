import {registerBlockType} from '@wordpress/blocks';
import {InspectorControls, RichText, useBlockProps, ColorPalette} from "@wordpress/block-editor";
import {
    Panel,
    PanelBody,
    PanelRow,
    ToggleControl,
    TextControl
} from '@wordpress/components';
import {__} from "@wordpress/i18n";

registerBlockType(
    'mpt-block/mpt-social-links-widget', {
        title: 'MPT Social Links Widget',
        icon: 'phone',
        category: 'widgets',
        keywords: ['contact info', 'mpt', 'social'],
        attributes: {

            title: {
                type: 'string',
                source: 'html',
                selector: 'h4',
            },

            iconColor: {
                type: 'string',
            },

            textColor: {
                type: 'string',
            },

            phone: {
                type: 'string',
                source: 'html',
                selector: '.mpt-block-phone-number',
            },

            email: {
                type: 'string',
                source: 'html',
                selector: '.mpt-block-email-id',
            },

            location: {
                type: 'string',
                source: 'html',
                selector: '.mpt-block-location-address',
            },

            showSociallinks: {
                type: 'boolean',
                default: true
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
        supports: {
            color: true // Enables background and text
        },


        edit: ({attributes, setAttributes}) => {
            const {
                title,
                facebook,
                twitter,
                instagram,
                dribbble,
                linkedin,
                iconColor,
                textColor,
                showSociallinks,
            } = attributes;

            return (
                <>
                    <InspectorControls>
                        <PanelBody title={__('Style')}>
                            <ColorPalette
                                label={__('Icon Color')}
                                value={ iconColor }
                                onChange={ ( colorValue ) => setAttributes( { iconColor: colorValue } ) }
                                styleHandle=".site-footer .widget ul li a"
                                allowReset
                            />

                            <ColorPalette
                                label={__('Text Color')}
                                value={ textColor }
                                onChange={ ( colorValue ) => setAttributes( { textColor: colorValue } ) }
                                allowReset
                            />
                        </PanelBody>
                        <PanelBody title={__('Social Links')}>
                            <ToggleControl label={__('Show Social links')} value={showSociallinks} checked={showSociallinks} onChange={val => setAttributes({showSociallinks: val})}/>

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
                    <div className="mpt_block_contact_info_widget">
                        {showSociallinks && (facebook || twitter || instagram || linkedin || dribbble || title) &&
                        <>

                            <RichText
                                key="title"
                                className="mpt-block-social-title"
                                tagName="h4"
                                value={title}
                                allowedFormats={['core/bold', 'core/italic']}
                                onChange={(title) => setAttributes({title})}
                                placeholder="Social Title..."
                            />

                            <ul className="mpt-block-social-link">
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
                                {linkedin &&
                                <li>
                                    <a className="mpt-social-linkedin"><i className="fab fa-linkedin-in"/></a>
                                </li>
                                }
                                {dribbble &&
                                <li>
                                    <a className="mpt-social-dribbble"><i className="fab fa-dribbble"/></a>
                                </li>
                                }
                            </ul>
                        </>
                        }
                    </div>

                </>
            )
        },

        save: ({attributes}) => {
            const {
                title,
                facebook,
                twitter,
                instagram,
                linkedin,
                dribbble,
                iconColor,
                textColor,
                showSociallinks
            } = attributes;

            return (
                <>
                    <div className="mpt_block_contact_info_widget">


                        {showSociallinks && (facebook || twitter || instagram || linkedin || dribbble || title) &&
                        <>
                            <h4 className="mpt-block-social-title">{title}</h4>
                            <ul className="mpt-block-social-link">
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
                                {linkedin &&
                                <li>
                                    <a href={linkedin} className="mpt-social-linkedin" target="_blank" rel="noopener noreferrer"><i className="fab fa-linkedin-in"/></a>
                                </li>
                                }
                                {dribbble &&
                                <li>
                                    <a href={dribbble} className="mpt-social-dribbble" target="_blank" rel="noopener noreferrer"><i className="fab fa-dribbble"/></a>
                                </li>
                                }
                            </ul>
                        </>
                        }
                    </div>
                </>
            )
        }
    }
);