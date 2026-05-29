#!/usr/bin/env node

import fs from "node:fs";
import path from "node:path";

function toKebabCase(value) {
  return value
    .trim()
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, "-")
    .replace(/^-+|-+$/g, "")
    .replace(/-{2,}/g, "-");
}

function toTitleCase(value) {
  return value
    .split("-")
    .filter(Boolean)
    .map((part) => part.charAt(0).toUpperCase() + part.slice(1))
    .join(" ");
}

function printHelp() {
  console.log("Usage: rope-tow new block <block-name>");
  console.log("Example: rope-tow new block pricing-cards");
}

function ensureFileExists(filePath) {
  if (!fs.existsSync(filePath)) {
    throw new Error(`Required file not found: ${filePath}`);
  }
}

function appendLineIfMissing(filePath, line) {
  const current = fs.readFileSync(filePath, "utf8");
  if (current.includes(line)) {
    return false;
  }

  const needsTrailingNewline = !current.endsWith("\n");
  const updated = `${current}${needsTrailingNewline ? "\n" : ""}${line}\n`;
  fs.writeFileSync(filePath, updated, "utf8");
  return true;
}

function insertAfterLastMatch(filePath, line, matcher) {
  const current = fs.readFileSync(filePath, "utf8");
  if (current.includes(line)) {
    return false;
  }

  const lines = current.split("\n");
  let lastMatchIndex = -1;

  for (let i = 0; i < lines.length; i += 1) {
    if (matcher.test(lines[i])) {
      lastMatchIndex = i;
    }
  }

  if (lastMatchIndex === -1) {
    return appendLineIfMissing(filePath, line);
  }

  lines.splice(lastMatchIndex + 1, 0, line);
  fs.writeFileSync(filePath, `${lines.join("\n")}\n`, "utf8");
  return true;
}

function writeBlockFiles(themeRoot, slug, title) {
  const blockDir = path.join(themeRoot, "blocks", slug);
  if (fs.existsSync(blockDir)) {
    throw new Error(`Block directory already exists: ${blockDir}`);
  }

  fs.mkdirSync(blockDir, { recursive: true });

  const blockJson = `{
  "$schema": "https://schemas.wp.org/trunk/block.json",
  "apiVersion": 3,
  "name": "rope-tow/${slug}",
  "title": "${title}",
  "category": "the-goods",
  "description": "${title} block with flexibility and style",
  "supports": {
    "html": false,
    "align": ["full", "wide"]
  },
  "attributes": {
    "cta1Label": {
			"type": "string",
			"default": "Learn More"
		},
    "cta1Url": {
			"type": "string",
			"default": ""
		},
		"cta1Style": {
			"type": "string",
			"default": "primary"
		},
    "cta2Label": {
			"type": "string",
			"default": "Get Started"
		},
    "cta2Url": {
			"type": "string",
			"default": ""
		},
		"cta2Style": {
			"type": "string",
			"default": "secondary"
		}
  },
  "example": {
    "attributes": {
      "cta1Label": "Get Started",
      "cta1Url": "#",
      "cta1Style": "primary",
      "cta2Label": "Contact Sales",
      "cta2Url": "#",
      "cta2Style": "secondary"
    }
  },
  "render": "file:./${slug}.php"
}
`;

  const jsx = `import "./editor.scss";
import { buttonStyleOptions, backgroundColorOptions, textColorOptions } from "../../assets/admin/js/blocks/block-options";
import { SpacingControls } from "../../assets/admin/js/blocks/spacingControls";
import { BackgroundControls } from "../../assets/admin/js/blocks/backgroundControls";
import { ButtonPairControls } from "../../assets/admin/js/blocks/buttonPair";

const { blocks, blockEditor, components } = window.wp || {};

if (!blocks || !blockEditor || !components) {
  // If WordPress block editor APIs are not available.
} else {
  const { registerBlockType } = blocks;
  const { InspectorControls, useBlockProps } = blockEditor;
  const { PanelBody } = components;

  registerBlockType("rope-tow/${slug}", {
    edit: ({ attributes, setAttributes }) => {
      const {
        // Global shared attributes
        paddingTop, paddingBottom, marginTop, marginBottom,
        backgroundImage, backgroundColor, backgroundAttachment, textColor,
        // Block-specific attributes
        cta1Label, cta1Url, cta1Style, cta2Label, cta2Url, cta2Style
      } = attributes;

      // Define the block's props
      const blockProps = useBlockProps({
        className: "rt-${slug} rt-block section pt-" + paddingTop + " pb-" + paddingBottom + " mt-" + marginTop + " mb-" + marginBottom + " bg-" + backgroundColor + " text-" + textColor,
      });
      const bgImgClass = backgroundAttachment && backgroundAttachment === "fixed" ? "bg-attachment-image-fixed" : "";

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
              {/* CTAs */}
              {(cta1Url || cta2Url) && (
                <div className="rt-${slug}__ctas flex gap-3 mt-4">
                  {cta1Url && (
                    <a href={cta1Url} className={"rt-${slug}__cta rt-${slug}__cta--primary btn btn-" + cta1Style}>
                      {cta1Label}
                    </a>
                  )}
                  {cta2Url && (
                    <a href={cta2Url} className={"rt-${slug}__cta rt-${slug}__cta--secondary btn btn-" + cta2Style}>
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
`;

  const php = `<?php
/**
 * ${title} block render template.
 *
 * @package RopeTow
 */

if (!defined('ABSPATH')) {
  exit;
}

// Gather block-specific attributes with defaults


// Gather shared attributes using helper functions
$ctas = rope_tow_block_cta_attributes( $attributes );
$basics = rope_tow_block_basics_attributes( $attributes );

// Define block wrapper classes and attributes
$wrapper_attributes = get_block_wrapper_attributes( [
  'class' => 'rt-${slug} rt-block section pt-' . esc_attr( $basics['padding_top'] ) . ' pb-' . esc_attr( $basics['padding_bottom'] ) . ' mt-' . esc_attr( $basics['margin_top'] ) . ' mb-' . esc_attr( $basics['margin_bottom'] ) . ' bg-' . esc_attr( $basics['background_color'] ) . ' text-' . esc_attr( $basics['text_color'] ),
] );
?>

<div <?php echo $wrapper_attributes; ?>>
  <!-- Background image -->
  <?php if ( $basics['background_image_id'] ) { ?>
    <div class="rt-block__bg <?php echo esc_attr( $basics['background_attachment_class'] ); ?>" aria-hidden="true">
      <?php echo wp_get_attachment_image( $basics['background_image_id'], 'full', false, [
        'class'   => 'rt-block__bg-img',
        'loading' => 'lazy',
        'decoding' => 'async',
      ] ); ?>
    </div>
  <?php } ?>

  <!-- Content area -->
  <div class="rt-block__content container">
    <!-- CTAs -->
    <?php if ( $ctas['cta1_url'] || $ctas['cta2_url'] ) { ?>
      <div class="rt-${slug}__ctas flex gap-3 mt-4">
        <?php if ( $ctas['cta1_url'] ) { ?>
          <a href="<?php echo esc_url( $ctas['cta1_url'] ); ?>" class="rt-${slug}__cta rt-${slug}__cta--primary btn btn-<?php echo esc_attr( $ctas['cta1_style'] ); ?>">
            <?php echo esc_html( $ctas['cta1_label'] ); ?>
          </a>
        <?php } ?>
        <?php if ( $ctas['cta2_url'] ) { ?>
          <a href="<?php echo esc_url( $ctas['cta2_url'] ); ?>" class="rt-${slug}__cta rt-${slug}__cta--secondary btn btn-<?php echo esc_attr( $ctas['cta2_style'] ); ?>">
            <?php echo esc_html( $ctas['cta2_label'] ); ?>
          </a>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>
`;

  const scss = `// @use '../../assets/scss/base/shared' as *;

// .rt-${slug} {

// }
`;

  const editorScss = "// Block-editor-specific style overrides.\n";

  fs.writeFileSync(path.join(blockDir, "block.json"), blockJson, "utf8");
  fs.writeFileSync(path.join(blockDir, `${slug}.jsx`), jsx, "utf8");
  fs.writeFileSync(path.join(blockDir, `${slug}.php`), php, "utf8");
  fs.writeFileSync(path.join(blockDir, `${slug}.scss`), scss, "utf8");
  fs.writeFileSync(path.join(blockDir, "editor.scss"), editorScss, "utf8");

  return blockDir;
}

function main() {
  try {
    const args = process.argv.slice(2);
    if (args.length < 3 || args[0] !== "new" || args[1] !== "block") {
      printHelp();
      process.exit(args.length === 0 ? 0 : 1);
    }

    const rawName = args.slice(2).join(" ");
    const slug = toKebabCase(rawName);
    if (!slug) {
      throw new Error("Block name is empty after normalization.");
    }

    const title = toTitleCase(slug);
    const themeRoot = process.cwd();

    const editorJsPath = path.join(themeRoot, "assets", "admin", "js", "blocks", "editor.js");
    const blocksAllPath = path.join(themeRoot, "assets", "scss", "blocks", "_all.scss");
    ensureFileExists(editorJsPath);
    ensureFileExists(blocksAllPath);

    const blockDir = writeBlockFiles(themeRoot, slug, title);

    const importLine = `import "../../../../blocks/${slug}/${slug}.jsx";`;
    insertAfterLastMatch(
      editorJsPath,
      importLine,
      /^import\s+"\.\.\/\.\.\/\.\.\/\.\.\/blocks\/.+\.jsx";$/
    );

    const scssUseLine = `@use "../../../blocks/${slug}/${slug}";`;
    appendLineIfMissing(blocksAllPath, scssUseLine);

    console.log(`Created block scaffold: ${blockDir}`);
    console.log(`Updated editor imports: ${editorJsPath}`);
    console.log(`Updated block styles index: ${blocksAllPath}`);
    console.log("Done.");
  } catch (error) {
    console.error(`Error: ${error.message}`);
    process.exit(1);
  }
}

main();
