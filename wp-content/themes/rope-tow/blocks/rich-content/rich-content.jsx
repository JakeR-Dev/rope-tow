import "./editor.scss";
import { SpacingControls } from "../../assets/admin/js/blocks/spacingControls";
import { BackgroundControls } from "../../assets/admin/js/blocks/backgroundControls";

const { blocks, blockEditor, components } = window.wp || {};

if (!blocks || !blockEditor || !components) {
  // If WordPress block editor APIs are not available.
} else {
  const { registerBlockType } = blocks;
  const { InspectorControls, InnerBlocks, useBlockProps } = blockEditor;
  const { PanelBody } = components;

  const ALLOWED_BLOCKS = ["core/paragraph", "core/heading", "core/list"];

  registerBlockType("rope-tow/rich-content", {
    edit: ({ attributes, setAttributes }) => {
      const {
        // Global shared attributes
        paddingTop, paddingBottom, marginTop, marginBottom,
        backgroundImage, backgroundColor, backgroundAttachment, textColor,
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

            {/* Rich content area */}
            <div className="rt-block__content container">
              <div className="rt-rich-content__body">
                <InnerBlocks
                  allowedBlocks={ALLOWED_BLOCKS}
                  template={[['core/paragraph', { placeholder: 'Add rich content...' }]]}
                />
              </div>
            </div>
          </div>
        </>
      );
    },

    save: () => <InnerBlocks.Content />,
  });
}