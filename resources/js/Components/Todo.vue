<template>
    <div
        class="bg-gray-100 py-2 px-4 rounded flex flex-row justify-between items-center space-x-4"
    >
        <div class="flex flex-row">
            <input
                class="font-nunito"
                type="checkbox"
                :true-value="1"
                v-model="todoForm.is_done"
                @change="save"
            />
            <p class="ml-2">{{ todoForm.task }}</p>
        </div>
        <button type="button" @click="deleteTodo">
            <XMarkIcon class="h-6 w-6 text-blue-500" />
        </button>
    </div>
</template>

<script setup>
import { XMarkIcon } from "@heroicons/vue/24/solid";
import { useForm } from "@inertiajs/vue3";

// This time store a reference to props so we can pull in the defaults in the form
const props = defineProps(["todo"]);

// Populate form defaults based on the prop data
const todoForm = useForm({
    task: props.todo.task,
    is_done: props.todo.is_done,
});

// Send an update request for the todo
const save = () => {
    todoForm.put(`/todos/${props.todo.id}`);
};

const deleteTodo = () => {
    todoForm.delete(`/todos/${props.todo.id}`);
};
</script>
