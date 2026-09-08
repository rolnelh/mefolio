@props(['value' => '', 'class' => ''])

@php
    $initialTags = collect(explode(',', $value ?? ''))
        ->map(fn ($t) => trim($t))
        ->filter()
        ->values()
        ->all();
@endphp

<div x-data="{
        tags: {{ json_encode($initialTags) }},
        input: '',
        add() {
            const v = this.input.trim();
            if (v && !this.tags.includes(v)) this.tags.push(v);
            this.input = '';
        },
        remove(i) { this.tags.splice(i, 1); },
    }">
    <div class="flex flex-wrap gap-1.5 mb-2" x-show="tags.length" x-cloak>
        <template x-for="(tag, i) in tags" :key="tag + i">
            <span class="inline-flex items-center gap-1 bg-indigo-50 text-indigo-700 text-xs font-semibold pl-2.5 pr-1.5 py-1 rounded-full">
                <span x-text="tag"></span>
                <button type="button" @click="remove(i)"
                    class="w-4 h-4 flex items-center justify-center rounded-full text-indigo-400 hover:text-white hover:bg-indigo-400 transition-colors leading-none">
                    &times;
                </button>
            </span>
        </template>
    </div>
    <input type="text" x-model="input"
        @keydown.enter.prevent="add()"
        @keydown.backspace="if (input === '' && tags.length) tags.pop()"
        @blur="add()"
        placeholder="Ex : Figma — Entrée pour ajouter"
        class="{{ $class }}">
    <input type="hidden" name="technologies" :value="tags.join(', ')">
</div>
