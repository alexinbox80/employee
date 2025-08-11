export default {

    _getHtml(message, type = 'success') {
        return `<div class="alert alert-${type} alert-dismissible fade show">
                                ${message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`;
    },

    renderBlock(container, message, type = 'success', target = 'afterbegin') {
        container.insertAdjacentHTML(target, this._getHtml(message, type));
        return true;
    },

    alertBlockAutoClose(block, delay) {
        setTimeout(function() {
            if (block) {
                block.textContent = '';
            }
            //location.reload();
        }, delay);
    }
}
