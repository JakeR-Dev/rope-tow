import "./editor.scss";
import { headingTagOptions, buttonStyleOptions, backgroundColorOptions, textColorOptions } from "../../assets/admin/js/blocks/block-options";
import { SpacingControls } from "../../assets/admin/js/blocks/spacingControls";
import { BackgroundControls } from "../../assets/admin/js/blocks/backgroundControls";
import { ButtonPairControls } from "../../assets/admin/js/blocks/buttonPair";

const { blocks, blockEditor, components, element } = window.wp || {};

if (!blocks || !blockEditor || !components || !element) {
  // If WordPress block editor APIs are not available.
} else {
  const { registerBlockType } = blocks;
  const { InspectorControls, useBlockProps, BlockControls, RichText } = blockEditor;
  const { useState } = element;
  const { PanelBody, ToolbarDropdownMenu, TextControl, TextareaControl, SelectControl } = components;

  registerBlockType("rope-tow/contact-form", {
    edit: ({ attributes, setAttributes }) => {
      const {
        // Global shared attributes
        paddingTop, paddingBottom, marginTop, marginBottom,
        backgroundImage, backgroundColor, backgroundAttachment, textColor,
        // Block-specific attributes
        title, pretitle, subtitle, titleTag, pretitleTag, subtitleTag,
        cta1Label, cta1Url, cta1Style, cta2Label, cta2Url, cta2Style,
        layout
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

      // Define the block's props
      const blockProps = useBlockProps({
        className: "rt-contact-form rt-block section pt-" + paddingTop + " pb-" + paddingBottom + " mt-" + marginTop + " mb-" + marginBottom + " bg-" + backgroundColor + " text-" + textColor,
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

            {/* Contact Form */}
            <PanelBody title="Layout" initialOpen={false}>
              {/* Layout controls */}
              <SelectControl
                label="Layout"
                value={layout}
                options={[
                  { label: 'Stacked', value: 'span-12' },
                  { label: 'Side By Side', value: 'span-6' },
                ]}
                onChange={(val) => setAttributes({ layout: val })}
              />
            </PanelBody>

            {/* CTA button controls */}
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

            {/* Content area */}
            <div className="rt-block__content container">
              <div className="rt-block__contact-layout grid">
                {/* Content side */}
                <div className={`rt-block__contact-side ${layout}`}>
                  {/* Pretitle */}
                  <RichText
                    tagName='p'
                    className={`${pretitleTag} rt-contact-form__pretitle mb-2`}
                    value={pretitle}
                    onFocus={() => setActiveTextField('pretitle')}
                    onChange={(val) => setAttributes({ pretitle: val })}
                    placeholder="Lorem Ipsum Dolor"
                    allowedFormats={['core/bold', 'core/italic']}
                  />

                  {/* Title */}
                  <RichText
                    tagName={titleTag || 'h1'}
                    className="rt-contact-form__title mb-3 mt-0"
                    value={title}
                    onFocus={() => setActiveTextField('title')}
                    onChange={(val) => setAttributes({ title: val })}
                    placeholder="Contact Form Title"
                    allowedFormats={['core/italic']}
                  />

                  {/* Subtitle */}
                  <RichText
                    tagName={subtitleTag || 'p'}
                    className="rt-contact-form__subtitle mb-3"
                    value={subtitle}
                    onFocus={() => setActiveTextField('subtitle')}
                    onChange={(val) => setAttributes({ subtitle: val })}
                    placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                    allowedFormats={['core/bold', 'core/italic']}
                  />
                  
                  {/* CTAs */}
                  {(cta1Url || cta2Url) && (
                    <div className="rt-contact-form__ctas flex gap-3 mt-4">
                      {cta1Url && (
                        <a href={cta1Url} className={"rt-contact-form__cta rt-contact-form__cta--primary btn btn-" + cta1Style}>
                          {cta1Label}
                        </a>
                      )}
                      {cta2Url && (
                        <a href={cta2Url} className={"rt-contact-form__cta rt-contact-form__cta--secondary btn btn-" + cta2Style}>
                          {cta2Label}
                        </a>
                      )}
                    </div>
                  )}
                </div>

                {/* Form side */}
                <div className={`rt-block__contact-side ${layout}`}>

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
