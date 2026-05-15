import { spacingOptions } from "./block-options";

const { components } = window.wp || {};
const SelectControl = components?.SelectControl;

export function SpacingControls({
	paddingTop,
	paddingBottom,
	marginTop,
	marginBottom,
	setAttributes,
}) {
	if (!SelectControl) {
		return null;
	}

	return (
		<>
			{/* Padding top */}
			<SelectControl
				label="Padding Top"
				value={paddingTop}
				options={spacingOptions}
				onChange={(val) => setAttributes({ paddingTop: val })}
			/>

			{/* Padding bottom */}
			<SelectControl
				label="Padding Bottom"
				value={paddingBottom}
				options={spacingOptions}
				onChange={(val) => setAttributes({ paddingBottom: val })}
			/>

			{/* Margin top */}
			<SelectControl
				label="Margin Top"
				value={marginTop}
				options={spacingOptions}
				onChange={(val) => setAttributes({ marginTop: val })}
			/>

			{/* Margin bottom */}
			<SelectControl
				label="Margin Bottom"
				value={marginBottom}
				options={spacingOptions}
				onChange={(val) => setAttributes({ marginBottom: val })}
			/>
		</>
	);
}