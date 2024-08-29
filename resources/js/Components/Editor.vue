<script setup>
import { useEditor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";
import typography from "@tailwindcss/typography";
import Underline from "@tiptap/extension-underline";
import { watch } from "vue";
import "../../css/editorStyle.css";

const props = defineProps({
    modelValue: {
        type: String,
        default: "",
    },
    bgColor: {
        type: String,
        default:'bg-gray-100'
    }
});

const emits = defineEmits(["update:modelValue"]);

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit, Underline, typography],
    autofocus: true,
    editorProps: {
        attributes: {
            class: `w-full min-h-[200px] ${props.bgColor} prose prose-sm sm:prose lg:prose-lg xl:prose-2xl focus:outline-none border-gray-400 rounded p-2`,
        },
    },
    onUpdate: () => emits("update:modelValue", editor.value.getHTML()),
});

watch(
    () => props.modelValue,
    (value) => {
        let isSame = editor.value.getHTML() === value;
        if (isSame) return;

        editor.value.commands.setContent(value, false);
    }
);
</script>

<template>
    <div v-if="!!editor">
        <div class="flex items-center gap-4 font-bold mb-4">
            <div
                class="flex items-center gap-3 text-gray-200 flex-wrap button-group"
            >
                <button
                    @click="editor.chain().focus().toggleBold().run()"
                    :disabled="!editor.can().chain().focus().toggleBold().run()"
                    :class="{ 'is-active': editor.isActive('bold') }"
                    type="button"
                >
                    Bold
                </button>
                <button
                    @click="editor.chain().focus().toggleItalic().run()"
                    :disabled="
                        !editor.can().chain().focus().toggleItalic().run()
                    "
                    :class="{ 'is-active': editor.isActive('italic') }"
                    type="button"
                >
                    Italic
                </button>
                <button
                    @click="editor.chain().focus().toggleStrike().run()"
                    :disabled="
                        !editor.can().chain().focus().toggleStrike().run()
                    "
                    :class="{ 'is-active': editor.isActive('strike') }"
                    type="button"
                >
                    Strike
                </button>
                <button
                    @click="editor.chain().focus().toggleCode().run()"
                    :disabled="!editor.can().chain().focus().toggleCode().run()"
                    :class="{ 'is-active': editor.isActive('code') }"
                    type="button"
                >
                    Code
                </button>
                <button @click="editor.chain().focus().unsetAllMarks().run()">
                    Clear marks
                </button>
                <button @click="editor.chain().focus().clearNodes().run()">
                    Clear nodes
                </button>
                <button
                    @click="editor.chain().focus().setParagraph().run()"
                    :class="{ 'is-active': editor.isActive('paragraph') }"
                    type="button"
                >
                    Paragraph
                </button>
                <button
                    @click="
                        editor.chain().focus().toggleHeading({ level: 1 }).run()
                    "
                    :class="{
                        'is-active': editor.isActive('heading', { level: 1 }),
                    }"
                    type="button"
                >
                    H1
                </button>
                <button
                    @click="
                        editor.chain().focus().toggleHeading({ level: 2 }).run()
                    "
                    :class="{
                        'is-active': editor.isActive('heading', { level: 2 }),
                    }"
                    type="button"
                >
                    H2
                </button>
                <button
                    @click="
                        editor.chain().focus().toggleHeading({ level: 3 }).run()
                    "
                    :class="{
                        'is-active': editor.isActive('heading', { level: 3 }),
                    }"
                    type="button"
                >
                    H3
                </button>
                <button
                    @click="
                        editor.chain().focus().toggleHeading({ level: 4 }).run()
                    "
                    :class="{
                        'is-active': editor.isActive('heading', { level: 4 }),
                    }"
                    type="button"
                >
                    H4
                </button>
                <button
                    @click="
                        editor.chain().focus().toggleHeading({ level: 5 }).run()
                    "
                    :class="{
                        'is-active': editor.isActive('heading', { level: 5 }),
                    }"
                    type="button"
                >
                    H5
                </button>
                <button
                    @click="
                        editor.chain().focus().toggleHeading({ level: 6 }).run()
                    "
                    :class="{
                        'is-active': editor.isActive('heading', { level: 6 }),
                    }"
                    type="button"
                >
                    H6
                </button>
                <button
                    @click="editor.chain().focus().toggleBulletList().run()"
                    :class="{ 'is-active': editor.isActive('bulletList') }"
                    type="button"
                >
                    Bullet list
                </button>
                <button
                    @click="editor.chain().focus().toggleOrderedList().run()"
                    :class="{ 'is-active': editor.isActive('orderedList') }"
                    type="button"
                >
                    Ordered list
                </button>
                <button
                    @click="editor.chain().focus().toggleUnderline().run()"
                    :class="{ 'is-active': editor.isActive('underline') }"
                    type="button"
                >
                    Toggle underline
                </button>
                <button
                    @click="editor.chain().focus().toggleCodeBlock().run()"
                    :class="{ 'is-active': editor.isActive('codeBlock') }"
                    type="button"
                >
                    Code block
                </button>
                <button
                    @click="editor.chain().focus().toggleBlockquote().run()"
                    :class="{ 'is-active': editor.isActive('blockquote') }"
                    type="button"
                >
                    Blockquote
                </button>
                <button
                    @click="editor.chain().focus().setHorizontalRule().run()"
                    type="button"
                >
                    Horizontal rule
                </button>
                <button @click="editor.chain().focus().setHardBreak().run()">
                    Hard break
                </button>
                <button
                    @click="editor.chain().focus().undo().run()"
                    :disabled="!editor.can().chain().focus().undo().run()"
                    type="button"
                >
                    Undo
                </button>
                <button
                    @click="editor.chain().focus().redo().run()"
                    :disabled="!editor.can().chain().focus().redo().run()"
                    type="button"
                >
                    Redo
                </button>
                <button
                    @click="editor.chain().focus().setColor('#958DF1').run()"
                    :class="{
                        'is-active': editor.isActive('textStyle', {
                            color: '#958DF1',
                        }),
                    }"
                    type="button"
                >
                    Purple
                </button>
            </div>
        </div>
        <div>
            <editor-content :editor="editor" />
        </div>
    </div>
</template>

<style scoped>
.button-group button {
    padding: 5px;
    border: 2px;
    border-color: red;
    border-radius: 5px;
    background: gray;
    transition: background 0.7s ease;
}

.button-group .is-active {
    background: #4a9afc;
}
</style>
