<script setup lang="ts">
import CenterContent from '@/components/custom/CenterContent.vue';
import NavLayouts from '@/layouts/NavLayouts.vue';

import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit';

const editor = useEditor({
    editorProps: {
        attributes: {
            class: 'border border-gray-400 p-4 min-h-[12rem] max-h-[12rem] overflow-y-auto outline-none prose lg:prose-xl max-w-none prose-headings:p-0 prose-headings:m-0 prose-headings:font-mono prose-p:font-mono prose-p:p-0 prose-p:m-0 prose-p:text-[0.875rem] prose-ol:py-0 prose-ol:my-0 prose-ul:py-0 prose-ul:my-0 prose-li:py-0 prose-li:my-0 marker:text-[0.875rem] prose-blockquote:py-0 prose-blockquote:my-0 prose-hr:py-0 prose-hr:my-0',
        },
    },
    content: "<p>I'm running Tiptap with Vue.js. 🎉</p>",
    extensions: [StarterKit],
});

</script>
<template>
    <NavLayouts>
        <CenterContent>
            <header>
                <h1 class="font-mono text-2xl font-bold">Post a Job</h1>
            </header>

            <article>
                <section>
                    <aside>
                        <section v-if="editor"
                            class="buttons flex items-center flex-wrap gap-x-4 border-t border-x border-gray-400 p-4">
                            <button @click="editor.chain().focus().toggleBold().run()"
                                :disabled="!editor.can().chain().focus().toggleBold().run()"
                                :class="{ 'bg-gray-200 rounded': editor.isActive('bold') }" class="p-1">Bold</button>
                            <button @click="editor.chain().focus().toggleItalic().run()"
                                :disabled="!editor.can().chain().focus().toggleItalic().run()"
                                :class="{ 'bg-gray-200 rounded': editor.isActive('italic') }"
                                class="p-1">italic</button>
                            <button @click="editor.chain().focus().toggleUnderline().run()"
                                :disabled="!editor.can().chain().focus().toggleItalic().run()"
                                :class="{ 'bg-gray-200 rounded': editor.isActive('underline') }"
                                class="p-1">underline</button>
                            <button @click="editor.chain().focus().toggleStrike().run()"
                                :disabled="!editor.can().chain().focus().toggleStrike().run()"
                                :class="{ 'bg-gray-200 rounded': editor.isActive('strike') }">
                                Strike
                            </button>

                            <button @click="editor.chain().focus().unsetAllMarks().run()">Clear marks</button>
                            <button @click="editor.chain().focus().clearNodes().run()">Clear nodes</button>
                            <button @click="editor.chain().focus().setParagraph().run()"
                                :class="{ 'bg-gray-200 rounded': editor.isActive('paragraph') }">
                                Paragraph
                            </button>
                            <button @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                                :class="{ 'bg-gray-200 rounded': editor.isActive('heading', { level: 2 }) }">
                                H2
                            </button>
                            <button @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
                                :class="{ 'bg-gray-200 rounded': editor.isActive('heading', { level: 3 }) }">
                                H3
                            </button>
                            <button @click="editor.chain().focus().toggleHeading({ level: 4 }).run()"
                                :class="{ 'bg-gray-200 rounded': editor.isActive('heading', { level: 4 }) }">
                                H4
                            </button>

                            <button @click="editor.chain().focus().toggleBulletList().run()"
                                :class="{ 'bg-gray-200 rounded': editor.isActive('bulletList') }">
                                Bullet list
                            </button>
                            <button @click="editor.chain().focus().toggleOrderedList().run()"
                                :class="{ 'bg-gray-200 rounded': editor.isActive('orderedList') }">
                                Ordered list
                            </button>
                            <button @click="editor.chain().focus().toggleBlockquote().run()"
                                :class="{ 'bg-gray-200 rounded': editor.isActive('blockquote') }">
                                Blockquote
                            </button>
                            <button @click="editor.chain().focus().setHorizontalRule().run()">Horizontal rule</button>
                            <button @click="editor.chain().focus().undo().run()"
                                :disabled="!editor.can().chain().focus().undo().run()"
                                class="p-1 disabled:text-gray-300"
                                >
                                Undo
                            </button>
                            <button 
                                @click="editor.chain().focus().redo().run()"
                                :disabled="!editor.can().chain().focus().redo().run()"
                                class="p-1 disabled:text-gray-300"
                                >
                                Redo
                            </button>

                        </section>
                        <EditorContent :editor="editor" />
                    </aside>
                </section>
            </article>
        </CenterContent>
    </NavLayouts>
</template>
