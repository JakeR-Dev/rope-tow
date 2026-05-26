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
  const { InspectorControls, BlockControls, RichText, useBlockProps } = blockEditor;
  const { useState } = element;
  const { PanelBody, ToolbarDropdownMenu, TextControl, TextareaControl, Button, SelectControl, RangeControl } = components;

  registerBlockType("rope-tow/content-grid", {
    edit: ({ attributes, setAttributes }) => {
      const {
        // Global shared attributes
        paddingTop, paddingBottom, marginTop, marginBottom,
        backgroundImage, backgroundColor, backgroundAttachment, textColor,
        // Block-specific attributes
        title, pretitle, subtitle, titleTag, pretitleTag, subtitleTag, items,
        cta1Label, cta1Url, cta1Style, cta2Label, cta2Url, cta2Style,
        gridColumns, gridItemBorderRadius
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

      // Grid items repeater logic
      const gridItems = Array.isArray(items) ? items : [];
      const addGridItem = () => {
        setAttributes({
          items: [
            ...gridItems,
            {
              title: '',
              titleTag: 'h4',
              description: '',
              backgroundColor: 'white',
              textColor: 'dark',
              icon: '',
              linkLabel: '',
              linkUrl: '',
              buttonStyle: 'primary',
            },
          ],
        });
      };

      const updateGridItem = (index, field, value) => {
        const nextItems = gridItems.map((item, itemIndex) => (
          itemIndex === index ? { ...item, [field]: value } : item
        ));

        setAttributes({ items: nextItems });
      };

      const removeGridItem = (index) => {
        setAttributes({
          items: gridItems.filter((_, itemIndex) => itemIndex !== index),
        });
      };

      // Define the block's props
      const blockProps = useBlockProps({
        className: 'rt-content-grid rt-block section pt-' + paddingTop + ' pb-' + paddingBottom + ' mt-' + marginTop + ' mb-' + marginBottom + ' bg-' + backgroundColor + ' text-' + textColor,
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

              <hr />

              {/* Grid items per row */}
              <SelectControl
                label="Grid Items Per Row"
                value={gridColumns}
                options={[
                  { label: '1', value: 'span-12' },
                  { label: '2', value: 'span-6' },
                  { label: '3', value: 'span-4' },
                  { label: '4', value: 'span-3' },
                ]}
                onChange={(val) => setAttributes({ gridColumns: val })}
              />

              {/* Grid items border radius */}
              <RangeControl
                label="Grid Item Border Radius (px)"
                value={gridItemBorderRadius ?? 8}
                onChange={(value) => setAttributes({ gridItemBorderRadius: value })}
                min={0}
                max={40}
                step={1}
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

            {/* Content grid repeater */}
            <PanelBody title="Grid Items" initialOpen={false}>
              {gridItems.length === 0 && (
                <p>Add your first grid item.</p>
              )}

              {gridItems.map((item, index) => (
                <div className="rt-content-grid__item-control" key={`grid-item-${index}`}>
                  <TextControl
                    label={`Item ${index + 1} Title`}
                    value={item?.title || ''}
                    onChange={(val) => updateGridItem(index, 'title', val)}
                  />
                  <SelectControl
                    label="Title Tag"
                    value={item?.titleTag || 'h5'}
                    options={headingTagOptions}
                    onChange={(val) => updateGridItem(index, 'titleTag', val)}
                  />
                  <TextareaControl
                    label="Description"
                    value={item?.description || ''}
                    onChange={(val) => updateGridItem(index, 'description', val)}
                  />
                  <SelectControl
                    label="Background Color"
                    value={item?.backgroundColor || 'white'}
                    options={backgroundColorOptions}
                    onChange={(val) => updateGridItem(index, 'backgroundColor', val)}
                  />
                  <SelectControl
                    label="Text Color"
                    value={item?.textColor || 'dark'}
                    options={textColorOptions}
                    onChange={(val) => updateGridItem(index, 'textColor', val)}
                  />
                  <TextControl
                    label="Icon (Font Awesome class)"
                    value={item?.icon || ''}
                    onChange={(val) => updateGridItem(index, 'icon', val)}
                    help={
                      <>
                        Example: fa-solid fa-star <a href="https://fontawesome.com/v6/search?ic=free-collection" target="_blank" rel="noopener noreferrer"> Need Icons?</a>
                      </>
                    }
                  />
                  <TextControl
                    label="Button Label"
                    value={item?.linkLabel || ''}
                    onChange={(val) => updateGridItem(index, 'linkLabel', val)}
                  />
                  <TextControl
                    label="Button URL"
                    value={item?.linkUrl || ''}
                    onChange={(val) => updateGridItem(index, 'linkUrl', val)}
                  />
                  <SelectControl
                    label="Button Style"
                    value={item?.buttonStyle || 'primary'}
                    options={buttonStyleOptions}
                    onChange={(val) => updateGridItem(index, 'buttonStyle', val)}
                  />
                  <Button
                    isDestructive
                    variant="secondary"
                    onClick={() => removeGridItem(index)}
                  >
                    Remove Item
                  </Button>
                  <hr />
                </div>
              ))}

              <Button variant="primary" onClick={addGridItem}>
                Add Item
              </Button>
            </PanelBody>
          </InspectorControls>

          {/* Render the block content in the editor */}
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
              <div className="flex">
                <div className="flex-12 md:flex-10 xl:flex-8 mx-auto text-center">
                  {/* Pretitle */}
                  <RichText
                    tagName='p'
                    className={`${pretitleTag} rt-content-grid__pretitle mb-0`}
                    value={pretitle}
                    onFocus={() => setActiveTextField('pretitle')}
                    onChange={(val) => setAttributes({ pretitle: val })}
                    placeholder="Lorem Ipsum Dolor"
                    allowedFormats={['core/bold', 'core/italic']}
                  />

                  {/* Title */}
                  <RichText
                    tagName={titleTag || 'h1'}
                    className="rt-content-grid__title mb-3"
                    value={title}
                    onFocus={() => setActiveTextField('title')}
                    onChange={(val) => setAttributes({ title: val })}
                    placeholder="Content Grid Title"
                    allowedFormats={['core/italic']}
                  />

                  {/* Subtitle */}
                  <RichText
                    tagName={subtitleTag || 'p'}
                    className="rt-content-grid__subtitle mb-3"
                    value={subtitle}
                    onFocus={() => setActiveTextField('subtitle')}
                    onChange={(val) => setAttributes({ subtitle: val })}
                    placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                    allowedFormats={['core/bold', 'core/italic']}
                  />

                  {/* CTAs */}
                  {(cta1Url || cta2Url) && (
                    <div className="rt-content-grid__ctas flex flex-center gap-3 my-4">
                      {cta1Url && (
                        <a href={cta1Url} className={`rt-content-grid__cta rt-content-grid__cta--primary btn btn-${cta1Style}`}>
                          {cta1Label}
                        </a>
                      )}
                      {cta2Url && (
                        <a href={cta2Url} className={`rt-content-grid__cta rt-content-grid__cta--secondary btn btn-${cta2Style}`}>
                          {cta2Label}
                        </a>
                      )}
                    </div>
                  )}

                  {/* Repeated items */}
                  {(gridItems.length > 0) && (
                    <div className="rt-content-grid__items grid gap-3 mt-4">
                      {gridItems.map((item, index) => {
                        const ItemTitleTag = item?.titleTag || 'h5';
                        const itemBgColor = item?.backgroundColor || 'white';
                        const itemTextColor = item?.textColor || 'dark';
                        const itemIcon = item?.icon;
                        const itemTitle = item?.title;
                        const itemDescription = item?.description;
                        const itemLinkUrl = item?.linkUrl;
                        const itemButtonStyle = item?.buttonStyle || 'primary';
                        const itemLinkLabel = item?.linkLabel || 'Learn more';

                        return (
                          <div className={`rt-content-grid__item span-12 sm:span-6 lg:${gridColumns} p-3 bg-${itemBgColor} text-${itemTextColor}`} key={`grid-item-preview-${index}`} style={{ borderRadius: `${gridItemBorderRadius ?? 8}px` }}>
                            {/* Icon */}
                            {itemIcon && <i className={itemIcon} aria-hidden="true" />}
                            {/* Title */}
                            {itemTitle && (
                              <ItemTitleTag className="rt-content-grid__item-title mb-2 ">{itemTitle}</ItemTitleTag>
                            )}
                            {/* Description */}
                            {itemDescription && (
                              <p className="rt-content-grid__item-description">{itemDescription}</p>
                            )}
                            {/* Button */}
                            {itemLinkUrl && (
                              <a className={`rt-content-grid__item-link btn btn-${itemButtonStyle}`} href={itemLinkUrl}>
                                {itemLinkLabel}
                              </a>
                            )}
                          </div>
                        );
                      })}
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