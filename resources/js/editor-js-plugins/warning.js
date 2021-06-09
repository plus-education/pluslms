/*
 * The editorConfig variable is used by you to add your tools,
 * or any additional configuration you might want to add to the editor.
 *
 * The fieldConfig variable is the VueJS field exposed to you. You may
 * fetch any value that is contained in your laravel config file from there.
 */
NovaEditorJS.booting(function (editorConfig, fieldConfig) {
    if (fieldConfig.toolSettings.warning.activated === true) {
        editorConfig.tools.warning = {
            class: require('@editorjs/warning'),
            shortcut: fieldConfig.toolSettings.warning.shortcut,
            config: {
                titlePlaceholder: fieldConfig.toolSettings.warning.titlePlaceholder,
                messagePlaceholder: fieldConfig.toolSettings.warning.messagePlaceholder,
            },
        }
    }
});
