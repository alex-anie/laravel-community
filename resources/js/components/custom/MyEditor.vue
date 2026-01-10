<script setup lang="ts">
import { Bold, Heading2, Heading3, Heading4, Italic, List, ListOrdered, Minus, Pilcrow, Redo, Strikethrough, TextQuote, Underline, Undo } from 'lucide-vue-next';

import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit';
import ToolTips from '@/components/custom/ToolTips.vue';

const props = defineProps({
    modelValue: String
});

const emit = defineEmits(['update:modelValue']);

const editor = useEditor({
    content: props.modelValue,
    onUpdate: async ({editor})=>{
        // console.log(editor.getHTML())
        emit('update:modelValue', editor.getHTML())
    },
    extensions: [StarterKit],
    editorProps: {
        attributes: {
            class: 'border border-gray-400 p-4 min-h-[30rem] max-h-[30rem] overflow-y-auto outline-none prose lg:prose-xl max-w-none prose-headings:p-0 prose-headings:m-0 prose-headings:font-mono prose-p:font-mono prose-p:p-0 prose-p:m-0 prose-p:text-[0.875rem] prose-ol:py-0 prose-ol:my-0 prose-ul:py-0 prose-ul:my-0 prose-li:py-0 prose-li:my-0 marker:text-[0.875rem] prose-blockquote:py-0 prose-blockquote:my-0 prose-hr:py-0 prose-hr:my-0',
        },
    },
});

</script>
<template>
    <article>
        <section v-if="editor"
            class="buttons flex items-center justify-between flex-wrap gap-x-4 border-t border-x border-gray-400 p-4 text-red-600">
                <ToolTips tooltip="paragraph">
                    <button type="button" @click="editor.chain().focus().setParagraph().run()"
                        :class="{ 'bg-red-200': editor.isActive('paragraph') }" class="p-1">
                        <Pilcrow class="size-4"/>
                    </button>
                </ToolTips>
        
                <ToolTips tooltip="heading2">
                    <button type="button" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                        :class="{ 'bg-red-200': editor.isActive('heading', { level: 2 }) }" class="p-1">
                        <Heading2 class="size-4" />
                    </button>
                </ToolTips>
            
                <ToolTips tooltip="heading3">
                    <button type="button" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
                        :class="{ 'bg-red-200': editor.isActive('heading', { level: 3 }) }" class="p-1">
                        <Heading3 class="size-4" />
                    </button>
                </ToolTips>
                <ToolTips tooltip="heading4">
                    <button type="button" @click="editor.chain().focus().toggleHeading({ level: 4 }).run()"
                        :class="{ 'bg-red-200': editor.isActive('heading', { level: 4 }) }" class="p-1">
                        <Heading4 class="size-4" />
                    </button>
                </ToolTips>
            
            <ToolTips tooltip="bold">
                <button type="button" @click="editor.chain().focus().toggleBold().run()"
                    :disabled="!editor.can().chain().focus().toggleBold().run()"
                    :class="{ 'bg-red-200': editor.isActive('bold') }" class="p-1">
                    <Bold class="size-4" />
                </button>
            </ToolTips>
        
            <ToolTips tooltip="italic">
                <button type="button" @click="editor.chain().focus().toggleItalic().run()"
                    :disabled="!editor.can().chain().focus().toggleItalic().run()"
                    :class="{ 'bg-red-200': editor.isActive('italic') }"
                    class="p-1">
                    <Italic class="size-4" />
                </button>
            </ToolTips>
        
            <ToolTips tooltip="underline">
                <button type="button" @click="editor.chain().focus().toggleUnderline().run()"
                    :disabled="!editor.can().chain().focus().toggleItalic().run()"
                    :class="{ 'bg-red-200': editor.isActive('underline') }"
                    class="p-1">
                    <Underline class="size-4" />
                </button>
            </ToolTips>
            
            <ToolTips tooltip="strike">
                <button type="button" @click="editor.chain().focus().toggleStrike().run()"
                    :disabled="!editor.can().chain().focus().toggleStrike().run()"
                    :class="{ 'bg-red-200': editor.isActive('strike') }" class="p-1">
                <Strikethrough class="size-4" />
            </button>
            </ToolTips>

            <ToolTips tooltip="list">
                <button type="button" @click="editor.chain().focus().toggleBulletList().run()"
                    :class="{ 'bg-red-200': editor.isActive('bulletList') }" class="p-1">
                    <List class="size-4" />
                </button>
            </ToolTips>
            
            <ToolTips tooltip="number">
                <button type="button" @click="editor.chain().focus().toggleOrderedList().run()"
                    :class="{ 'bg-red-200': editor.isActive('orderedList') }" class="p-1">
                    <ListOrdered class="size-4" />
                </button>
            </ToolTips>
            
            <ToolTips tooltip="blockquote">
                <button type="button" @click="editor.chain().focus().toggleBlockquote().run()"
                :class="{ 'bg-red-200': editor.isActive('blockquote') }" class="p-1">
                <TextQuote class="size-4" />
            </button>
            </ToolTips>
            
            <ToolTips tooltip="line-brake">
                <button type="button" @click="editor.chain().focus().setHorizontalRule().run()">
                <Minus class="size-4" />
            </button>
            </ToolTips>
        
            <ToolTips tooltip="undo">
                <button type="button" @click="editor.chain().focus().undo().run()"
                :disabled="!editor.can().chain().focus().undo().run()"
                class="p-1 disabled:text-gray-300"
                >
                <Undo class="size-4" />
                </button>
            </ToolTips>
            
            <ToolTips tooltip="redo">
                <button type="button" 
                    @click="editor.chain().focus().redo().run()"
                    :disabled="!editor.can().chain().focus().redo().run()"
                    class="p-1 disabled:text-gray-300"
                    >
                    <Redo class="size-4" />
                </button>
            </ToolTips>
        </section>
        <EditorContent :editor="editor" />
    </article>
</template>
