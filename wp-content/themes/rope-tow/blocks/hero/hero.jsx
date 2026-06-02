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
  const { InspectorControls, BlockControls, RichText, useBlockProps } = blockEditor;
  const { useState } = element;
  const { PanelBody, ToolbarDropdownMenu } = components;

  registerBlockType("rope-tow/hero", {
    edit: ({ attributes, setAttributes }) => {
      const {
        // Global shared attributes
        paddingTop, paddingBottom, marginTop, marginBottom,
        backgroundImage, backgroundColor, backgroundAttachment, backgroundOpacity,
        textColor,
        // Block-specific attributes
        title, subtitle, titleTag, subtitleTag,
        cta1Label, cta1Url, cta1Style, cta2Label, cta2Url, cta2Style,
      } = attributes;

      // Typography options for title/subtitle in toolbar
      const [activeTextField, setActiveTextField] = useState('title');
      const currentTag = activeTextField === 'subtitle' ? (subtitleTag || 'p') : (titleTag || 'h1');

      const setActiveFieldTag = (tag) => {
        if (activeTextField === 'subtitle') {
          setAttributes({ subtitleTag: tag });
          return;
        }
        setAttributes({ titleTag: tag });
      };

      // Define the block's props
      const blockProps = useBlockProps({
        className: 'rt-hero rt-block section pt-' + paddingTop + ' pb-' + paddingBottom + ' mt-' + marginTop + ' mb-' + marginBottom + ' bg-' + backgroundColor + ' text-' + textColor,
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
                backgroundOpacity={backgroundOpacity}
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
          </InspectorControls>

          <div {...blockProps}>

            {/* Background image */}
            {backgroundImage?.url && (
              <div className={`rt-block__bg ${bgImgClass}`} aria-hidden="true" style={{ opacity: backgroundOpacity / 100 }}>
                <img
                  src={backgroundImage.url}
                  alt=""
                  className="rt-block__bg-img"
                />
              </div>
            )}

            <div className="rt-block__content container">
              <div className="flex">
                <div className="flex-12 md:flex-10 xl:flex-8 mx-auto text-center">
                  {/* Title */}
                  <RichText
                    tagName={titleTag || 'h1'}
                    className="rt-hero__title mb-3 mt-0"
                    value={title}
                    onFocus={() => setActiveTextField('title')}
                    onChange={(val) => setAttributes({ title: val })}
                    placeholder="Hero Title"
                    allowedFormats={['core/italic']}
                  />

                  {/* Subtitle */}
                  <RichText
                    tagName={subtitleTag || 'p'}
                    className="rt-hero__subtitle mb-3"
                    value={subtitle}
                    onFocus={() => setActiveTextField('subtitle')}
                    onChange={(val) => setAttributes({ subtitle: val })}
                    placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                    allowedFormats={['core/bold', 'core/italic']}
                  />

                  {/* CTAs */}
                  {(cta1Url || cta2Url) && (
                    <div className="rt-hero__ctas flex flex-center gap-3 mt-4">
                      {cta1Url && (
                        <a href={cta1Url} className={`rt-hero__cta rt-hero__cta--primary btn btn-${cta1Style}`}>
                          {cta1Label}
                        </a>
                      )}
                      {cta2Url && (
                        <a href={cta2Url} className={`rt-hero__cta rt-hero__cta--secondary btn btn-${cta2Style}`}>
                          {cta2Label}
                        </a>
                      )}
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