const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"nova-settings.get":{"uri":"nova-vendor\/nova-settings\/settings","methods":["GET","HEAD"]},"nova-settings.save":{"uri":"nova-vendor\/nova-settings\/settings","methods":["POST"]},"languages.index":{"uri":"nova-vendor\/nova-translation\/languages","methods":["GET","HEAD"]},"languages.create":{"uri":"languages\/create","methods":["GET","HEAD"]},"languages.store":{"uri":"nova-vendor\/nova-translation\/languages","methods":["POST"]},"languages.translations.index":{"uri":"nova-vendor\/nova-translation\/languages\/{language}\/translations","methods":["GET","HEAD"]},"languages.translations.update":{"uri":"nova-vendor\/nova-translation\/languages\/{language}\/translations","methods":["PUT"]},"languages.translations.create":{"uri":"languages\/{language}\/translations\/create","methods":["GET","HEAD"]},"languages.translations.store":{"uri":"nova-vendor\/nova-translation\/languages\/{language}\/translations","methods":["POST"]},"login":{"uri":"login","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.update":{"uri":"reset-password","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"user-profile-information.update":{"uri":"user\/profile-information","methods":["PUT"]},"user-password.update":{"uri":"user\/password","methods":["PUT"]},"password.confirmation":{"uri":"user\/confirmed-password-status","methods":["GET","HEAD"]},"password.confirm":{"uri":"user\/confirm-password","methods":["POST"]},"two-factor.login":{"uri":"two-factor-challenge","methods":["GET","HEAD"]},"two-factor.enable":{"uri":"user\/two-factor-authentication","methods":["POST"]},"two-factor.confirm":{"uri":"user\/confirmed-two-factor-authentication","methods":["POST"]},"two-factor.disable":{"uri":"user\/two-factor-authentication","methods":["DELETE"]},"two-factor.qr-code":{"uri":"user\/two-factor-qr-code","methods":["GET","HEAD"]},"two-factor.secret-key":{"uri":"user\/two-factor-secret-key","methods":["GET","HEAD"]},"two-factor.recovery-codes":{"uri":"user\/two-factor-recovery-codes","methods":["GET","HEAD"]},"profile.show":{"uri":"user\/profile","methods":["GET","HEAD"]},"other-browser-sessions.destroy":{"uri":"user\/other-browser-sessions","methods":["DELETE"]},"current-user-photo.destroy":{"uri":"user\/profile-photo","methods":["DELETE"]},"current-user.destroy":{"uri":"user","methods":["DELETE"]},"nova.login":{"uri":"admin\/login","methods":["POST"]},"nova.logout":{"uri":"admin\/logout","methods":["GET","HEAD"]},"nova.password.request":{"uri":"admin\/password\/reset","methods":["GET","HEAD"]},"nova.password.email":{"uri":"admin\/password\/email","methods":["POST"]},"nova.password.reset":{"uri":"admin\/password\/reset\/{token}","methods":["GET","HEAD"]},"studentIsNotSolvent":{"uri":"studentIsNotSolvent","methods":["GET","HEAD"]},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"courses.index":{"uri":"courses\/{id}","methods":["GET","HEAD"]},"courses.topic":{"uri":"courses\/topic\/{id}","methods":["GET","HEAD"]},"courses.topic.activities":{"uri":"courses\/topic\/activities\/{id}","methods":["GET","HEAD"]},"courses.userByActivity":{"uri":"courses\/usersByActivity\/{id}","methods":["GET","HEAD"]},"courses.saveActivity":{"uri":"courses\/saveActivity","methods":["POST"]},"courses.topicGradebookPdf":{"uri":"course\/topic\/gradebookPdf\/{id}","methods":["GET","HEAD"]},"courses.topicGradebookExcel":{"uri":"course\/topic\/gradebookExcel\/{id}","methods":["GET","HEAD"]},"editor-js-upload-image-by-file":{"uri":"nova-vendor\/editor-js-field\/upload\/file","methods":["POST"]},"editor-js-upload-image-by-url":{"uri":"nova-vendor\/editor-js-field\/upload\/url","methods":["POST"]},"editor-js-fetch-url":{"uri":"nova-vendor\/editor-js-field\/fetch\/url","methods":["GET","HEAD"]},"nova.filepond.process":{"uri":"nova-vendor\/nova-filepond\/process","methods":["POST"]},"nova.filepond.revert":{"uri":"nova-vendor\/nova-filepond\/revert","methods":["DELETE"]},"nova.filepond.load":{"uri":"nova-vendor\/nova-filepond\/load","methods":["GET","HEAD"]},"nova.impersonate.take":{"uri":"nova-impersonate\/users\/{id}\/{guardName?}","methods":["GET","HEAD"]},"nova.impersonate.leave":{"uri":"nova-impersonate\/leave","methods":["GET","HEAD"]},"nova.index":{"uri":"admin","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
