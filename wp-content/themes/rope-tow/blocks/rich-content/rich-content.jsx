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
  const { InspectorControls, BlockControls, useBlockProps } = blockEditor;
  const { PanelBody } = components;

  registerBlockType("rope-tow/rich-content", {
    edit: ({ attributes, setAttributes }) => {
      const {
        // Global shared attributes
        paddingTop, paddingBottom, marginTop, marginBottom,
        backgroundImage, backgroundColor, backgroundAttachment, textColor,
        // Block-specific attributes
        cta1Label, cta1Url, cta1Style, cta2Label, cta2Url, cta2Style,
      } = attributes;

      // Define the block's props
      const blockProps = useBlockProps({
        className: 'rt-rich-content rt-block section pt-' + paddingTop + ' pb-' + paddingBottom + ' mt-' + marginTop + ' mb-' + marginBottom + ' bg-' + backgroundColor + ' text-' + textColor,
      });
      const bgImgClass = backgroundAttachment && backgroundAttachment === 'fixed' ? 'bg-attachment-image-fixed' : '';

      return (
        <>
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
            
              {/* CTAs */}
              {(cta1Url || cta2Url) && (
                <div className="rt-rich-content__ctas flex gap-3 mt-4">
                  {cta1Url && (
                    <a href={cta1Url} className={`rt-rich-content__cta rt-rich-content__cta--primary btn btn-${cta1Style}`}>
                      {cta1Label}
                    </a>
                  )}
                  {cta2Url && (
                    <a href={cta2Url} className={`rt-rich-content__cta rt-rich-content__cta--secondary btn btn-${cta2Style}`}>
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