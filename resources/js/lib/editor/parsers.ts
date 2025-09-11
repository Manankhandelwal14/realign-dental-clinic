/**
 * Custom parsers for editorjs-html to include Editor.js classes in HTML output.
 * @module editorParsers
 */

import edjsHTML from 'editorjs-html';

// Define specific interfaces for block data
interface HeaderBlockData {
    text: string;
    level: number;
}

interface ParagraphBlockData {
    text: string;
}

interface ListBlockData {
    style: 'ordered' | 'unordered';
    items: { content: string }[];
}


interface CodeBlockData {
    code: string;
}

interface ImageBlockData {
    file?: { url: string; caption?: string };
    url?: string;
    caption?: string;
}

interface EmbedBlockData {
    html: string;
}

interface TableBlockData {
    content: string[][];
}

interface EditorBlock {
    type: string;
    data:
    | HeaderBlockData
    | ParagraphBlockData
    | ListBlockData
    | CodeBlockData
    | ImageBlockData
    | EmbedBlockData
    | TableBlockData;
}

/**
 * Custom parsers for Editor.js block types to include Editor.js classes.
 */
const customParsers = {
    header: (block: EditorBlock) => {
        const { text, level } = block.data as HeaderBlockData;
        return `<h${level} class="ce-header">${text}</h${level}>`;
    },
    paragraph: (block: EditorBlock) => {
        const { text } = block.data as ParagraphBlockData;
        return `<p class="cdx-block">${text}</p>`;
    },
    list: (block: EditorBlock) => {
        const { style, items } = block.data as ListBlockData;
        const tag = style === 'ordered' ? 'ol' : 'ul';
        const listItems = items
            .map((item) => `<li class="cdx-list__item">${item.content}</li>`)
            .join('');
        return `<${tag} class="cdx-list">${listItems}</${tag}>`;
    },
    code: (block: EditorBlock) => {
        const { code } = block.data as CodeBlockData;
        return `<pre class="cdx-code"><code>${code}</code></pre>`;
    },
    image: (block: EditorBlock) => {
        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-expect-error
        const { url, caption } = (block.data as ImageBlockData).file || block.data;
        return `<div class="cdx-block image-tool">
              <img class="image-tool__image-picture" src="${url}" alt="${caption || ''}">
              ${caption ? `<figcaption class="cdx-block">${caption}</figcaption>` : ''}
            </div>`;
    },
    embed: (block: EditorBlock) => {
        const { html } = block.data as EmbedBlockData;
        return `<div class="cdx-block embed-tool">${html}</div>`;
    },
    table: (block: EditorBlock) => {
        const { content } = block.data as TableBlockData;
        const rows = content
            .map((row) => `<tr>${row.map((cell) => `<td class="cdx-table__cell">${cell}</td>`).join('')}</tr>`)
            .join('');
        return `<table class="cdx-table">${rows}</table>`;
    },
};

/**
 * Initializes editorjs-html with custom parsers.
 * @returns Configured edjsHTML parser instance
 */
export const createEditorParser = () => edjsHTML(customParsers);