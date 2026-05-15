import { buttonStyleOptions } from "../blocks/block-options";

const { components } = window.wp || {};
const SelectControl = components?.SelectControl;
const TextControl = components?.TextControl;

export function ButtonPairControls({
  cta1Style,
  cta1Url,
  cta1Label,
  cta2Style,
  cta2Url,
  cta2Label,
  setAttributes
}) {
  if (!SelectControl || !TextControl) {
    return null;
  }

  return (
    <>
      {/* Button 1 label */}
      <TextControl
        label="Button 1 Label"
        value={cta1Label}
        onChange={(val) => setAttributes({ cta1Label: val })}
      />
      {/* Button 1 URL */}
      <TextControl
        label="Button 1 URL"
        value={cta1Url}
        onChange={(val) => setAttributes({ cta1Url: val })}
        type="url"
      />
      {/* Button 1 Style */}
      <SelectControl
        label="Button 1 Style"
        value={cta1Style}
        options={buttonStyleOptions}
        onChange={(val) => setAttributes({ cta1Style: val })}
      />
      <hr />
      {/* Button 2 label */}
      <TextControl
        label="Button 2 Label"
        value={cta2Label}
        onChange={(val) => setAttributes({ cta2Label: val })}
      />
      {/* Button 2 URL */}
      <TextControl
        label="Button 2 URL"
        value={cta2Url}
        onChange={(val) => setAttributes({ cta2Url: val })}
        type="url"
      />
      {/* Button 2 Style */}
      <SelectControl
        label="Button 2 Style"
        value={cta2Style}
        options={buttonStyleOptions}
        onChange={(val) => setAttributes({ cta2Style: val })}
      />
    </>
  );
}