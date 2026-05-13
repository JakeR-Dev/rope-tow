import "./hero.scss";
import "./editor.scss";

const { blocks, blockEditor, components, element, i18n } = window.wp || {};

if (!blocks || !blockEditor || !components || !element || !i18n) {
  // WordPress block editor APIs are not available.
} else {
  const { registerBlockType } = blocks;
  const { InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } = blockEditor;
  const { PanelBody, TextControl, TextareaControl, Button, ToggleControl } = components;
  const { createElement: el, Fragment } = element;
  const { __ } = i18n;

  registerBlockType("rope-tow/hero", {
    edit: ({ attributes, setAttributes }) => {
      const {
        title = "",
        subtitle = "",
        primaryCta = { text: "", url: "", target: "" },
        secondaryCta = { text: "", url: "", target: "" },
        backgroundImage = { id: 0, url: "", alt: "" }
      } = attributes;

      const blockProps = useBlockProps({ className: "block-hero" });
      const sectionStyle = backgroundImage?.url ? { backgroundImage: `url(${backgroundImage.url})` } : undefined;

      return el(
        Fragment,
        null,
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: __("Hero Content", "rope-tow"), initialOpen: true },
            el(TextControl, {
              label: __("Title", "rope-tow"),
              value: title,
              onChange: (value) => setAttributes({ title: value })
            }),
            el(TextareaControl, {
              label: __("Subtitle", "rope-tow"),
              value: subtitle,
              onChange: (value) => setAttributes({ subtitle: value })
            })
          ),
          el(
            PanelBody,
            { title: __("Primary CTA", "rope-tow"), initialOpen: false },
            el(TextControl, {
              label: __("Button Label", "rope-tow"),
              value: primaryCta?.text || "",
              onChange: (value) =>
                setAttributes({
                  primaryCta: { ...primaryCta, text: value }
                })
            }),
            el(TextControl, {
              label: __("Button URL", "rope-tow"),
              value: primaryCta?.url || "",
              onChange: (value) =>
                setAttributes({
                  primaryCta: { ...primaryCta, url: value }
                })
            }),
            el(ToggleControl, {
              label: __("Open in new tab", "rope-tow"),
              checked: primaryCta?.target === "_blank",
              onChange: (checked) =>
                setAttributes({
                  primaryCta: { ...primaryCta, target: checked ? "_blank" : "" }
                })
            })
          ),
          el(
            PanelBody,
            { title: __("Secondary CTA", "rope-tow"), initialOpen: false },
            el(TextControl, {
              label: __("Button Label", "rope-tow"),
              value: secondaryCta?.text || "",
              onChange: (value) =>
                setAttributes({
                  secondaryCta: { ...secondaryCta, text: value }
                })
            }),
            el(TextControl, {
              label: __("Button URL", "rope-tow"),
              value: secondaryCta?.url || "",
              onChange: (value) =>
                setAttributes({
                  secondaryCta: { ...secondaryCta, url: value }
                })
            }),
            el(ToggleControl, {
              label: __("Open in new tab", "rope-tow"),
              checked: secondaryCta?.target === "_blank",
              onChange: (checked) =>
                setAttributes({
                  secondaryCta: { ...secondaryCta, target: checked ? "_blank" : "" }
                })
            })
          ),
          el(
            PanelBody,
            { title: __("Background Image", "rope-tow"), initialOpen: false },
            el(MediaUploadCheck, null, el(MediaUpload, {
              onSelect: (media) =>
                setAttributes({
                  backgroundImage: {
                    id: media?.id || 0,
                    url: media?.url || "",
                    alt: media?.alt || ""
                  }
                }),
              allowedTypes: ["image"],
              value: backgroundImage?.id || 0,
              render: ({ open }) =>
                el(
                  Button,
                  { variant: "secondary", onClick: open },
                  backgroundImage?.id ? __("Replace Background Image", "rope-tow") : __("Select Background Image", "rope-tow")
                )
            })),
            backgroundImage?.id
              ? el(
                  Button,
                  {
                    variant: "tertiary",
                    onClick: () =>
                      setAttributes({
                        backgroundImage: { id: 0, url: "", alt: "" }
                      })
                  },
                  __("Remove Background Image", "rope-tow")
                )
              : null
          )
        ),
        el(
          "section",
          { ...blockProps, style: sectionStyle },
          el(
            "div",
            { className: "container" },
            el(
              "div",
              { className: "block-hero__content" },
              el("h2", { className: "block-hero__title" }, title || __("Hero Title", "rope-tow")),
              el("p", { className: "block-hero__subtitle" }, subtitle || __("Hero subtitle goes here.", "rope-tow")),
              el(
                "div",
                { className: "block-hero__actions" },
                primaryCta?.text ? el("span", { className: "block-hero__button block-hero__button--primary" }, primaryCta.text) : null,
                secondaryCta?.text
                  ? el("span", { className: "block-hero__button block-hero__button--secondary" }, secondaryCta.text)
                  : null
              )
            )
          )
        )
      );
    },
    save: () => null
  });
}
