import "./editor.scss";

const { blocks, blockEditor, components, element, i18n } = window.wp || {};

if (!blocks || !blockEditor || !components || !element || !i18n) {
  // If WordPress block editor APIs are not available.
} else {
  const { registerBlockType } = blocks;
  const { InspectorControls, BlockControls, MediaUpload, MediaUploadCheck, RichText, useBlockProps } = blockEditor;
  const { useState } = element;
  const { PanelBody, TextControl, SelectControl, ToolbarDropdownMenu, Button } = components;

  registerBlockType("rope-tow/hero", {
    edit: ({ attributes, setAttributes }) => {
      const {
        title,
        subtitle,
        cta1Label,
        cta1Url,
        cta2Label,
        cta2Url,
        backgroundImage,
        paddingTop,
        paddingBottom,
        titleTag,
        subtitleTag,
        textColor,
        backgroundColor,
        backgroundAttachment,
      } = attributes;

      const [activeTextField, setActiveTextField] = useState('title');

      const headingTagOptions = [
        { label: 'Paragraph (p)', value: 'p' },
        { label: 'Heading 1 (h1)', value: 'h1' },
        { label: 'Heading 2 (h2)', value: 'h2' },
        { label: 'Heading 3 (h3)', value: 'h3' },
        { label: 'Heading 4 (h4)', value: 'h4' },
        { label: 'Heading 5 (h5)', value: 'h5' },
        { label: 'Heading 6 (h6)', value: 'h6' },
      ];

      const currentTag = activeTextField === 'subtitle' ? (subtitleTag || 'p') : (titleTag || 'h1');

      const setActiveFieldTag = (tag) => {
        if (activeTextField === 'subtitle') {
          setAttributes({ subtitleTag: tag });
          return;
        }
        setAttributes({ titleTag: tag });
      };

      const blockProps = useBlockProps({
        className: 'rt-hero rt-block section pt-' + paddingTop + ' pb-' + paddingBottom + ' bg-' + backgroundColor + ' text-' + textColor,
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
              {/* Padding top */}
              <SelectControl
                label="Padding Top"
                value={paddingTop}
                options={[
                  { label: 'Small', value: 'small' },
                  { label: 'Medium', value: 'medium' },
                  { label: 'Large', value: 'large' },
                ]}
                onChange={(val) => setAttributes({ paddingTop: val })}
              />

              {/* Padding bottom */}
              <SelectControl
                label="Padding Bottom"
                value={paddingBottom}
                options={[
                  { label: 'Small', value: 'small' },
                  { label: 'Medium', value: 'medium' },
                  { label: 'Large', value: 'large' },
                ]}
                onChange={(val) => setAttributes({ paddingBottom: val })}
              />

              {/* Background image */}
              <MediaUploadCheck>
                <MediaUpload
                  onSelect={(media) => setAttributes({ backgroundImage: media })}
                  allowedTypes={['image']}
                  value={backgroundImage?.id}
                  render={({ open }) => (
                    <div>
                      {backgroundImage?.url && (
                        <img
                          src={backgroundImage.url}
                          alt="Background preview"
                          style={{ width: '100%', marginBottom: '8px' }}
                        />
                      )}
                      <Button onClick={open} variant="secondary">
                        {backgroundImage?.url ? 'Replace Image' : 'Select Image'}
                      </Button>
                      {backgroundImage?.url && (
                        <Button
                          onClick={() => setAttributes({ backgroundImage: {} })}
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

              {/* Background attachment */}
              <SelectControl
                label="Background Attachment"
                value={backgroundAttachment}
                options={[
                  { label: 'Scroll', value: 'scroll' },
                  { label: 'Fixed', value: 'fixed' },
                ]}
                onChange={(val) => setAttributes({ backgroundAttachment: val })}
              />

              {/* Background color */}
              <SelectControl
                label="Background Color"
                value={backgroundColor}
                options={[
                  { label: 'Primary', value: 'brand-primary' },
                  { label: 'Secondary', value: 'brand-secondary' },
                  { label: 'Tertiary', value: 'brand-tertiary' },
                  { label: 'Tertiary Alt', value: 'brand-tertiary-alt' },
                  { label: 'Black', value: 'color-black' },
                  { label: 'Gray', value: 'color-gray' },
                  { label: 'Gray Light', value: 'color-gray-light' },
                  { label: 'White', value: 'color-white' },
                ]}
                onChange={(val) => setAttributes({ backgroundColor: val })}
              />

              {/* Text color */}
              <SelectControl
                label="Text Color"
                value={textColor}
                options={[
                  { label: 'Light', value: 'light' },
                  { label: 'Dark', value: 'dark' },
                ]}
                onChange={(val) => setAttributes({ textColor: val })}
              />
            </PanelBody>

            {/* CTA Buttons */}
            <PanelBody title="CTA Buttons" initialOpen={false}>
              <TextControl
                label="Button 1 Label"
                value={cta1Label}
                onChange={(val) => setAttributes({ cta1Label: val })}
              />
              <TextControl
                label="Button 1 URL"
                value={cta1Url}
                onChange={(val) => setAttributes({ cta1Url: val })}
                type="url"
              />
              <TextControl
                label="Button 2 Label"
                value={cta2Label}
                onChange={(val) => setAttributes({ cta2Label: val })}
              />
              <TextControl
                label="Button 2 URL"
                value={cta2Url}
                onChange={(val) => setAttributes({ cta2Url: val })}
                type="url"
              />
            </PanelBody>
          </InspectorControls>

          <div {...blockProps}>

            {backgroundImage?.url && (
              <div className={`rt-hero__bg ${bgImgClass}`} aria-hidden="true">
                <img
                  src={backgroundImage.url}
                  alt=""
                  className="rt-hero__bg-img"
                />
              </div>
            )}

            <div className="rt-hero__content container">
              <div className="flex">
                <div className="flex-12 md:flex-10 xl:flex-8 mx-auto text-center">
                  {/* title */}
                  <RichText
                    tagName={titleTag || 'h1'}
                    className="rt-hero__title"
                    value={title}
                    onFocus={() => setActiveTextField('title')}
                    onChange={(val) => setAttributes({ title: val })}
                    placeholder="Hero title..."
                    allowedFormats={[]}
                  />
                  {/* subtitle */}
                  <RichText
                    tagName={subtitleTag || 'p'}
                    className="rt-hero__subtitle"
                    value={subtitle}
                    onFocus={() => setActiveTextField('subtitle')}
                    onChange={(val) => setAttributes({ subtitle: val })}
                    placeholder="Subtitle or tagline..."
                    allowedFormats={['core/bold', 'core/italic']}
                  />
                  {/* ctas */}
                  <div className="rt-hero__ctas">
                    {cta1Url && (
                      <a href={cta1Url} className="rt-hero__cta rt-hero__cta--primary btn btn-primary">
                        {cta1Label}
                      </a>
                    )}
                    {cta2Url && (
                      <a href={cta2Url} className="rt-hero__cta rt-hero__cta--secondary btn btn-secondary">
                        {cta2Label}
                      </a>
                    )}
                  </div>
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