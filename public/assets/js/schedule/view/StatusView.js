import paragraph from './Paragraph.js';

export default {

    render(container, active) {
        if (parseInt(active.id) === 0) {
            paragraph.removeParagraphs(container, active);
            paragraph.createParagraph(container, active);
        } else
            paragraph.createParagraph(container, active);
    }
}
