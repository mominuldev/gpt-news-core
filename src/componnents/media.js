import { __ } from "@wordpress/i18n"
import './media.scss'
import { Component } from "@wordpress/element"
import { MediaUpload } from "@wordpress/block-editor"
import { Tooltip } from "@wordpress/components"

class Media extends Component {

    setSettings(media) {
        const { multiple, onChange, value } = this.props
        if (multiple) {
            let medias = [];
            media.forEach(single => {
                if (single && single.url) {
                    medias.push({ url: single.url, id: single.id });
                }
            });
            onChange(value ? value.concat(medias) : medias);
        } else {
            if (media && media.url) {
                onChange({ url: media.url, id: media.id });
            }
        }
    }

    removeImage(id) {
        const { multiple, onChange } = this.props
        if (multiple) {
            let value = (this.props.value).slice()
            value.splice(id, 1)
            onChange(value)
        } else {
            onChange({})
        }
    }

    isUrl(url) {
        if (['wbm', 'jpg', 'jpeg', 'gif', 'png', 'svg'].indexOf(url.split('.').pop().toLowerCase()) != -1) {
            return url;
        } else {
            return apdash_admin.plugin + 'assets/img/apdash-medium.jpg';
        }
    }


    render() {
        const { type, multiple, value, panel, video } = this.props;
        return (
            <div className='apdash-media'>
                {this.props.label &&
                <label>{this.props.label}</label>
                }
                <MediaUpload
                    onSelect={val => this.setSettings(val)}
                    allowedTypes={type.length ? [...type] : ['image']}
                    multiple={multiple || false}
                    value={value}
                    render={({ open }) => (
                        <div className="apdash-single-img">
                            <div>
                                {multiple ?
                                    <div>
                                        {(value.length > 0) &&
                                        value.map((v, index) => {
                                            return (
                                                <span className="apdash-media-image-parent">
														<img src={this.isUrl(v.url)} alt={__('image')} />
                                                    {panel &&
                                                    <div className="apdash-media-actions apdash-field-button-list">
                                                        <Tooltip text={__('Edit')}>
                                                            <button className="apdash-button" aria-label={__('Edit')} onClick={open} role="button">
                                                                <span aria-label={__('Edit')} className="fas fa-pencil-alt fa-fw" />
                                                            </button>
                                                        </Tooltip>
                                                        <Tooltip text={__('Remove')}>
                                                            <button className="apdash-button" aria-label={__('Remove')} onClick={() => this.removeImage(index)} role="button">
                                                                <span aria-label={__('Close')} className="far fa-trash-alt fa-fw" />
                                                            </button>
                                                        </Tooltip>
                                                    </div>
                                                    }
													</span>
                                            )
                                        })
                                        }
                                        <div onClick={open} className={"apdash-placeholder-image"}><div className="dashicon dashicons dashicons-insert" /><div>{__('Insert')}</div></div>
                                    </div>
                                    :
                                    ((value && value.url) ?
                                            <span className="apdash-media-image-parent">
											{
                                                video ?
                                                    <video controls autoPlay loop src={value.url} />
                                                    :
                                                    <img src={this.isUrl(value.url)} alt={__('image')} />
                                            }

                                                {panel &&
                                                <div className="apdash-media-actions apdash-field-button-list">
                                                    <Tooltip text={__('Edit')}>
                                                        <button className="apdash-button" aria-label={__('Edit')} onClick={open} role="button">
                                                            <span aria-label={__('Edit')} className="fas fa-pencil-alt fa-fw" />
                                                        </button>
                                                    </Tooltip>
                                                    <Tooltip text={__('Remove')}>
                                                        <button className="apdash-button" aria-label={__('Remove')} onClick={() => this.removeImage(value.id)} role="button">
                                                            <span aria-label={__('Close')} className="far fa-trash-alt fa-fw" />
                                                        </button>
                                                    </Tooltip>
                                                </div>
                                                }
										</span>
                                            :
                                            <div onClick={open} className={"apdash-placeholder-image"}><div className="dashicon dashicons dashicons-insert" /><div>{__('Insert')}</div></div>
                                    )
                                }
                            </div>
                        </div>
                    )}
                />
            </div>
        );
    }
}
export default Media;