import "./editor.scss";
import EmblaCarousel from "embla-carousel";
import { headingTagOptions, buttonStyleOptions, backgroundColorOptions, textColorOptions } from "../../assets/admin/js/blocks/block-options";
import { SpacingControls } from "../../assets/admin/js/blocks/spacingControls";
import { BackgroundControls } from "../../assets/admin/js/blocks/backgroundControls";
import { ButtonPairControls } from "../../assets/admin/js/blocks/buttonPair";

const { blocks, blockEditor, components, element } = window.wp || {};

if (!blocks || !blockEditor || !components || !element) {
  // If WordPress block editor APIs are not available.
} else {
  const { registerBlockType } = blocks;
  const { InspectorControls, BlockControls, RichText, useBlockProps, MediaUpload, MediaUploadCheck } = blockEditor;
  const { useState, useCallback, useEffect, useRef } = element;
  const { PanelBody, ToolbarDropdownMenu, SelectControl, TextControl, TextareaControl, Button } = components;

  registerBlockType("rope-tow/slider", {
    edit: ({ attributes, setAttributes }) => {
      const {
        // Global shared attributes
        paddingTop, paddingBottom, marginTop, marginBottom,
        backgroundImage, backgroundColor, backgroundAttachment, textColor,
        // Block-specific attributes
        title, pretitle, subtitle, titleTag, pretitleTag, subtitleTag,
        sliderStyle, items,
        cta1Label, cta1Url, cta1Style, cta2Label, cta2Url, cta2Style
      } = attributes;

      // Typography options for title/subtitle in toolbar
      const [activeTextField, setActiveTextField] = useState('title');

      // Track the current text field's tag
      const currentTag = (
        activeTextField === 'subtitle' ? (subtitleTag || 'p') :
          activeTextField === 'pretitle' ? (pretitleTag || 'h6') :
            (titleTag || 'h1'));

      const setActiveFieldTag = (tag) => {
        if (activeTextField === 'subtitle') {
          setAttributes({ subtitleTag: tag });
          return;
        } else if (activeTextField === 'pretitle') {
          setAttributes({ pretitleTag: tag });
          return;
        }
        setAttributes({ titleTag: tag });
      };

      const emblaNodeRef = useRef(null);
      const [emblaApi, setEmblaApi] = useState(null);

      useEffect(() => {
        if (!emblaNodeRef.current) {
          return;
        }

        const api = EmblaCarousel(emblaNodeRef.current, {
          loop: false,
          align: 'start',
          dragFree: true,
        });

        setEmblaApi(api);

        return () => {
          api.destroy();
          setEmblaApi(null);
        };
      }, []);

      useEffect(() => {
        if (emblaApi) {
          emblaApi.reInit();
        }
      }, [emblaApi, Array.isArray(items) ? items.length : 0, sliderStyle]);

      // Slider prev arrow
      const scrollPrev = useCallback(() => {
        if (emblaApi) {
          emblaApi.scrollPrev();
        }
      }, [emblaApi]);

      // Slider next arrow
      const scrollNext = useCallback(() => {
        if (emblaApi) {
          emblaApi.scrollNext();
        }
      }, [emblaApi]);

      // Slider items repeater logic
      const sliderItems = Array.isArray(items) ? items : [];
      const sliderPreviewItems = sliderItems.length > 0 ? sliderItems : [
        {
          title: 'Starter',
          description: 'Great for testing and small campaigns.',
          backgroundColor: 'white',
          textColor: 'dark',
          linkLabel: 'Learn more',
          linkUrl: '#',
          buttonStyle: 'primary',
          image: '',
        },
        {
          title: 'Growth',
          description: 'A balanced option for consistent growth.',
          backgroundColor: 'white',
          textColor: 'dark',
          linkLabel: 'See details',
          linkUrl: '#',
          buttonStyle: 'secondary',
          image: '',
        },
      ];
      const addSliderItem = () => {
        setAttributes({
          items: [
            ...sliderItems,
            {
              title: 'Starter',
              description: 'Great for testing and small campaigns.',
              backgroundColor: 'color-white',
              textColor: 'dark',
              linkLabel: 'Learn more',
              linkUrl: '#',
              buttonStyle: 'primary',
              image: ''
            },
          ],
        });
      };

      // Update slider item
      const updateSliderItem = (index, field, value) => {
        const nextItems = sliderItems.map((item, itemIndex) => (
          itemIndex === index ? { ...item, [field]: value } : item
        ));

        setAttributes({ items: nextItems });
      };

      // Remove slider item
      const removeSliderItem = (index) => {
        setAttributes({
          items: sliderItems.filter((_, itemIndex) => itemIndex !== index),
        });
      };

      // Define the block's props
      const blockProps = useBlockProps({
        className: "rt-slider rt-block section pt-" + paddingTop + " pb-" + paddingBottom + " mt-" + marginTop + " mb-" + marginBottom + " bg-" + backgroundColor + " text-" + textColor,
      });
      const bgImgClass = backgroundAttachment && backgroundAttachment === "fixed" ? "bg-attachment-image-fixed" : "";

      return (
        <>
          {/* Text tag controls in the block toolbar for title + subtitle */}
          <BlockControls group="inline">
            <ToolbarDropdownMenu
              icon="heading"
              label="Text Tag"
              controls={headingTagOptions.map((option) => ({
                title: option.label,
                isActive: option.value === currentTag,
                onClick: () => setActiveFieldTag(option.value),
              }))}
            />
          </BlockControls>

          {/* Sidebar controls */}
          <InspectorControls>
            {/* Styles */}
            <PanelBody title="Styles" initialOpen={false}>
              {/* Padding and margin controls */}
              <SpacingControls
                paddingTop={paddingTop}
                paddingBottom={paddingBottom}
                marginTop={marginTop}
                marginBottom={marginBottom}
                setAttributes={setAttributes}
              />

              <hr />

              {/* Background and text color controls */}
              <BackgroundControls
                backgroundImage={backgroundImage}
                backgroundAttachment={backgroundAttachment}
                backgroundColor={backgroundColor}
                textColor={textColor}
                setAttributes={setAttributes}
              />
            </PanelBody>

            {/* Slider options */}
            <PanelBody title="Slider" initialOpen={false}>
              {/* Slider style */}
              <SelectControl
                label="Slider Style"
                value={sliderStyle}
                options={[
                  { label: 'Single', value: 'single' },
                  { label: 'Double', value: 'double' },
                  { label: 'Triple', value: 'triple' }
                ]}
                onChange={(val) => setAttributes({ sliderStyle: val })}
              />

              <hr />

              {/* Slider items repeater */}
              {sliderItems.length === 0 && (
                <p>Add your first slider item.</p>
              )}

              {sliderItems.map((item, index) => (
                <div className="rt-content-slider__item-control" key={`slider-item-${index}`}>
                  <MediaUploadCheck>
                    <MediaUpload
                      onSelect={(media) => updateSliderItem(index, 'image', media)}
                      allowedTypes={['image']}
                      value={item?.image?.id}
                      render={({ open }) => (
                        <div className="components-base-control components-background-controls">
                          {item?.image?.url && (
                            <img
                              src={item.image.url}
                              alt="Image preview"
                              style={{ width: '100%', marginBottom: '8px' }}
                            />
                          )}
                          <Button onClick={open} variant="secondary">
                            {item?.image?.url ? 'Replace Image' : 'Select Image'}
                          </Button>
                          {item?.image?.url && (
                            <Button
                              onClick={() => updateSliderItem(index, 'image', {})}
                              variant="link"
                              isDestructive
                              style={{ display: 'block', marginTop: '8px' }}
                            >
                              Remove Image
                            </Button>
                          )}
                        </div>
                      )}
                    />
                  </MediaUploadCheck>
                  <TextControl
                    label={`Item ${index + 1} Title`}
                    value={item?.title || ''}
                    onChange={(val) => updateSliderItem(index, 'title', val)}
                  />
                  <TextareaControl
                    label="Description"
                    value={item?.description || ''}
                    onChange={(val) => updateSliderItem(index, 'description', val)}
                  />
                  <SelectControl
                    label="Background Color"
                    value={item?.backgroundColor || 'color-white'}
                    options={backgroundColorOptions}
                    onChange={(val) => updateSliderItem(index, 'backgroundColor', val)}
                  />
                  <SelectControl
                    label="Text Color"
                    value={item?.textColor || 'dark'}
                    options={textColorOptions}
                    onChange={(val) => updateSliderItem(index, 'textColor', val)}
                  />
                  <TextControl
                    label="Button Label"
                    value={item?.linkLabel || ''}
                    onChange={(val) => updateSliderItem(index, 'linkLabel', val)}
                  />
                  <TextControl
                    label="Button URL"
                    value={item?.linkUrl || ''}
                    onChange={(val) => updateSliderItem(index, 'linkUrl', val)}
                  />
                  <SelectControl
                    label="Button Style"
                    value={item?.buttonStyle || 'primary'}
                    options={buttonStyleOptions}
                    onChange={(val) => updateSliderItem(index, 'buttonStyle', val)}
                  />
                  <Button
                    isDestructive
                    variant="secondary"
                    onClick={() => removeSliderItem(index)}
                  >
                    Remove Item
                  </Button>
                  <hr />
                </div>
              ))}

              <Button variant="primary" onClick={addSliderItem}>
                Add Item
              </Button>
            </PanelBody>

            {/* CTA Buttons */}
            <PanelBody title="CTA Buttons" initialOpen={false}>
              <ButtonPairControls
                cta1Label={cta1Label}
                cta1Url={cta1Url}
                cta1Style={cta1Style}
                cta2Label={cta2Label}
                cta2Url={cta2Url}
                cta2Style={cta2Style}
                setAttributes={setAttributes}
              />
            </PanelBody>
          </InspectorControls>

          {/* Render the block content in the editor */}
          <div {...blockProps}>

            {/* Background image */}
            {backgroundImage?.url && (
              <div className={"rt-block__bg " + bgImgClass} aria-hidden="true">
                <img src={backgroundImage.url} alt="" className="rt-block__bg-img" />
              </div>
            )}

            <div className="rt-block__content container">
              {/* Pretitle */}
              <RichText
                tagName='p'
                className={`${pretitleTag} rt-content-grid__pretitle mb-0 text-center`}
                value={pretitle}
                onFocus={() => setActiveTextField('pretitle')}
                onChange={(val) => setAttributes({ pretitle: val })}
                placeholder="Lorem Ipsum Dolor"
                allowedFormats={['core/bold', 'core/italic']}
              />

              {/* Title */}
              <RichText
                tagName={titleTag || 'h1'}
                className="rt-content-grid__title mb-3 mt-0 text-center"
                value={title}
                onFocus={() => setActiveTextField('title')}
                onChange={(val) => setAttributes({ title: val })}
                placeholder="Content Grid Title"
                allowedFormats={['core/italic']}
              />

              {/* Subtitle */}
              <RichText
                tagName={subtitleTag || 'p'}
                className="rt-content-grid__subtitle mb-3 text-center"
                value={subtitle}
                onFocus={() => setActiveTextField('subtitle')}
                onChange={(val) => setAttributes({ subtitle: val })}
                placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                allowedFormats={['core/bold', 'core/italic']}
              />

              {/* Slider */}
              <div className="rt-slider__slider my-4">
                <div className="rt-slider__embla" ref={emblaNodeRef}>
                  <div className="rt-slider__embla-container">
                    {sliderPreviewItems.map((slide, index) => (
                      <article className="rt-slider__embla-slide" key={`demo-slide-${index}`}>
                        <div className={`rt-slider__embla-slide-card bg-${slide.backgroundColor || 'white'} text-${slide.textColor || 'dark'}`}>
                          {slide.image?.url && (
                            <img
                              src={slide.image.url}
                              alt=""
                              className="rt-slider__embla-slide-image"
                            />
                          )}
                          <h3 className="rt-slider__embla-slide-title mb-2 mt-0">{slide.title}</h3>
                          <p className="rt-slider__embla-slide-description mb-3">{slide.description}</p>
                          {slide.linkLabel && (
                            <a href={slide.linkUrl || '#'} className={`btn btn-${slide.buttonStyle || 'primary'}`}>
                              {slide.linkLabel}
                            </a>
                          )}
                        </div>
                      </article>
                    ))}
                  </div>
                </div>

                {/* Slider controls */}
                <div className="rt-slider__controls flex gap-2 mt-3 flex-center">
                  <button type="button" className="btn btn-secondary" onClick={scrollPrev}>Prev</button>
                  <button type="button" className="btn btn-primary" onClick={scrollNext}>Next</button>
                </div>
              </div>

              {/* CTAs */}
              {(cta1Url || cta2Url) && (
                <div className="rt-slider__ctas flex flex-center gap-3 mt-4">
                  {cta1Url && (
                    <a href={cta1Url} className={"rt-slider__cta rt-slider__cta--primary btn btn-" + cta1Style}>
                      {cta1Label}
                    </a>
                  )}
                  {cta2Url && (
                    <a href={cta2Url} className={"rt-slider__cta rt-slider__cta--secondary btn btn-" + cta2Style}>
                      {cta2Label}
                    </a>
                  )}
                </div>
              )}
            </div>
          </div>
        </>
      );
    },

    save: () => null,
  });
}
