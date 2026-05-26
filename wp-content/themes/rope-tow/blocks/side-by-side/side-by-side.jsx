import "./editor.scss";
import { headingTagOptions } from "../../assets/admin/js/blocks/block-options";
import { SpacingControls } from "../../assets/admin/js/blocks/spacingControls";
import { BackgroundControls } from "../../assets/admin/js/blocks/backgroundControls";
import { ButtonPairControls } from "../../assets/admin/js/blocks/buttonPair";

const { blocks, blockEditor, components, element } = window.wp || {};

if (!blocks || !blockEditor || !components || !element) {
  // If WordPress block editor APIs are not available.
} else {
  const { registerBlockType } = blocks;
  const { InspectorControls, BlockControls, RichText, useBlockProps, MediaUpload, MediaUploadCheck } = blockEditor;
  const { useState } = element;
  const { PanelBody, ToolbarDropdownMenu, Button, SelectControl, RangeControl } = components;

  registerBlockType("rope-tow/side-by-side", {
    edit: ({ attributes, setAttributes }) => {
      const {
        // Global shared attributes
        paddingTop, paddingBottom, marginTop, marginBottom,
        backgroundImage, backgroundColor, backgroundAttachment, textColor,
        // Block-specific attributes
        title, pretitle, subtitle, titleTag, pretitleTag, subtitleTag,
        cta1Label, cta1Url, cta1Style, cta2Label, cta2Url, cta2Style, image,
        verticalAlignment, imageBorderRadius, imageSide
      } = attributes;

      // Typography options for title/subtitle in toolbar
      const [activeTextField, setActiveTextField] = useState('title');
      const currentTag = 
        activeTextField === 'subtitle' ? (subtitleTag || 'p') :
        activeTextField === 'pretitle' ? (pretitleTag || 'h6') :
        (titleTag || 'h1');

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

      // Define the block's props
      const blockProps = useBlockProps({
        className: 'rt-side-by-side rt-block section pt-' + paddingTop + ' pb-' + paddingBottom + ' mt-' + marginTop + ' mb-' + marginBottom + ' bg-' + backgroundColor + ' text-' + textColor + ' image-side-' + imageSide,
      });
      const bgImgClass = backgroundAttachment && backgroundAttachment === 'fixed' ? 'bg-attachment-image-fixed' : '';

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

            {/* Image Options */}
            <PanelBody title="Image" initialOpen={false}>
              {/* Vert. Alignment */}
              <SelectControl
                label="Vertical Alignment"
                value={verticalAlignment}
                options={[
                  { label: 'Center', value: 'center' },
                  { label: 'Top', value: 'top' },
                  { label: 'Bottom', value: 'bottom' },
                ]}
                onChange={(val) => setAttributes({ verticalAlignment: val })}
              />

              {/* Image Side */}
              <SelectControl
                label="Image Side"
                value={imageSide}
                options={[
                  { label: 'Right', value: 'right' },
                  { label: 'Left', value: 'left' }
                ]}
                onChange={(val) => setAttributes({ imageSide: val })}
              />

              {/* Image border radius */}
              <RangeControl
                label="Image Border Radius (%)"
                value={imageBorderRadius ?? 0}
                onChange={(value) => setAttributes({ imageBorderRadius: value })}
                min={0}
                max={50}
                step={1}
              />

              {/* Image */}
              <MediaUploadCheck>
                <MediaUpload
                  onSelect={(media) => setAttributes({ image: media })}
                  allowedTypes={['image']}
                  value={image?.id}
                  render={({ open }) => (
                    <div className="components-base-control components-background-controls">
                      {image?.url && (
                        <img
                          src={image.url}
                          alt="Image preview"
                          style={{ width: '100%', marginBottom: '8px' }}
                        />
                      )}
                      <Button onClick={open} variant="secondary">
                        {image?.url ? 'Replace Image' : 'Select Image'}
                      </Button>
                      {image?.url && (
                        <Button
                          onClick={() => setAttributes({ image: {} })}
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
            </PanelBody>
          </InspectorControls>

          <div {...blockProps}>

            {/* Background image */}
            {backgroundImage?.url && (
              <div className={`rt-block__bg ${bgImgClass}`} aria-hidden="true">
                <img
                  src={backgroundImage.url}
                  alt=""
                  className="rt-block__bg-img"
                />
              </div>
            )}

            <div className="rt-block__content container">
              <div className={`flex align-${verticalAlignment}`}>
                {/* Content side */}
                <div className="flex-12 md:flex-6 rt-side-by-side__content-col">
                  {/* Pretitle */}
                  <RichText
                    tagName='p'
                    className={`${pretitleTag} rt-side-by-side__pretitle mb-0`}
                    value={pretitle}
                    onFocus={() => setActiveTextField('pretitle')}
                    onChange={(val) => setAttributes({ pretitle: val })}
                    placeholder="Lorem Ipsum Dolor"
                    allowedFormats={['core/bold', 'core/italic']}
                  />
                  
                  {/* Title */}
                  <RichText
                    tagName={titleTag || 'h1'}
                    className="rt-side-by-side__title mt-0 mb-3"
                    value={title}
                    onFocus={() => setActiveTextField('title')}
                    onChange={(val) => setAttributes({ title: val })}
                    placeholder="Side-By-Side Title"
                    allowedFormats={['core/italic']}
                  />

                  {/* Subtitle */}
                  <RichText
                    tagName={subtitleTag || 'p'}
                    className="rt-side-by-side__subtitle mb-4"
                    value={subtitle}
                    onFocus={() => setActiveTextField('subtitle')}
                    onChange={(val) => setAttributes({ subtitle: val })}
                    placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                    allowedFormats={['core/bold', 'core/italic']}
                  />

                  {/* CTAs */}
                  {(cta1Url || cta2Url) && (
                    <div className="rt-side-by-side__ctas flex gap-3 mt-4">
                      {cta1Url && (
                        <a href={cta1Url} className={`rt-side-by-side__cta rt-side-by-side__cta--primary btn btn-${cta1Style}`}>
                          {cta1Label}
                        </a>
                      )}
                      {cta2Url && (
                        <a href={cta2Url} className={`rt-side-by-side__cta rt-side-by-side__cta--secondary btn btn-${cta2Style}`}>
                          {cta2Label}
                        </a>
                      )}
                    </div>
                  )}
                </div>

                {/* Image side */}
                <div className="flex-12 md:flex-6 rt-side-by-side__img-col">
                  {/* Image */}
                  {image?.url && (
                    <div className="rt-side-by-side__img-wrapper">
                      <img
                        src={image.url}
                        alt=""
                        className="rt-side-by-side__img"
                        style={{ borderRadius: `${imageBorderRadius ?? 0}%` }}
                      />
                    </div>
                  )}
                </div>
              </div>
            </div>
          </div>
        </>
      );
    },

    save: () => null,
  });
}