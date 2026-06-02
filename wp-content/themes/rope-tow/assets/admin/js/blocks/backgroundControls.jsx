import { backgroundColorOptions, backgroundAttachmentOptions, textColorOptions } from "./block-options";

const { components, blockEditor } = window.wp || {};
const SelectControl = components?.SelectControl;
const MediaUpload = blockEditor?.MediaUpload;
const MediaUploadCheck = blockEditor?.MediaUploadCheck;
const Button = components?.Button;
const RangeControl = components?.RangeControl;

export function BackgroundControls({
  backgroundImage,
  backgroundAttachment,
  backgroundColor,
  backgroundOpacity,
  textColor,
  setAttributes
}) {
  if (!SelectControl || !MediaUpload || !MediaUploadCheck || !Button || !RangeControl) {
    return null;
  }

  return (
    <>
      {/* Background image */}
      <MediaUploadCheck>
        <MediaUpload
          onSelect={(media) => setAttributes({ backgroundImage: media })}
          allowedTypes={['image']}
          value={backgroundImage?.id}
          render={({ open }) => (
            <div className="components-base-control components-background-controls">
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
        options={backgroundAttachmentOptions}
        onChange={(val) => setAttributes({ backgroundAttachment: val })}
      />

      {/* Background color */}
      <SelectControl
        label="Background Color"
        value={backgroundColor}
        options={backgroundColorOptions}
        onChange={(val) => setAttributes({ backgroundColor: val })}
      />

      {/* Background opacity */}
      <RangeControl
        label="Background Opacity"
        value={backgroundOpacity}
        onChange={(val) => setAttributes({ backgroundOpacity: val })}
        min={0}
        max={100}
        step={1}
      />
      
      <hr />

      {/* Text color */}
      <SelectControl
        label="Text Color"
        value={textColor}
        options={textColorOptions}
        onChange={(val) => setAttributes({ textColor: val })}
      />
    </>
  );
}