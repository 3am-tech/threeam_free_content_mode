import AjaxRequest from "@typo3/core/ajax/ajax-request.js";

/**
 * Module: @threeam/threeamfreecontentmode/context-menu-actions
 *
 * JavaScript to handle the click action of the "Hello World" context menu item
 */

class ContextMenuActions {
    setPageContentModeToFree(table, uid, dataset) {
        if (table === "pages") {
            let request = new AjaxRequest(TYPO3.settings.ajaxUrls.threeamfreecontentmode_freemode);
            let queryArguments = {
                uid: uid
            };
            request = request.withQueryArguments(queryArguments);

            let promise = request.get();
            promise.then(async function (response) {
                const responseJson = await response.resolve();
                if (responseJson.status === "success") {
                    top.TYPO3.Notification.success("Free Mode", "Free Mode set for (" + responseJson.affectedContentElements + ") element(s) successfully", 5);
                    window.location.reload();
                }
            });
        }
    }
}

export default new ContextMenuActions();
