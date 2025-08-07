export default class StatusView {

    _createParagraph(context, selectedValue) {
        const paragraph = document.createElement('p');
        paragraph.style.backgroundColor = selectedValue.color;
        paragraph.textContent = selectedValue.letter;
        paragraph.classList.add('table__grid-p');
        paragraph.setAttribute('title', selectedValue.description);
        console.log(paragraph);
        context.appendChild(paragraph);
    }

    render($container, $active) {
        this._createParagraph($container, $active);
    }
}
