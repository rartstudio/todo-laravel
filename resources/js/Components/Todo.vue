<template>
    <div
        class="bg-gray-100 py-2 px-4 rounded flex flex-row justify-between items-center space-x-4"
    >
        <div class="flex-grow flex flex-row">
            <select
                @change="updatePriority"
                class="font-nunito block px-2 py-1.5 bg-gray-100 rounded mr-4"
                v-model="todoForm.priority"
            >
                <option disabled value="">Select priority</option>
                <option
                    v-for="(priority, index) in todoPriorities"
                    :key="index"
                    :value="index"
                    :selected="index === todoForm.priority"
                >
                    {{ priority }}
                </option>
            </select>
            <input
                class="font-nunito"
                type="checkbox"
                :true-value="1"
                v-model="todoForm.is_done"
                @change="updateTaskDone"
            />
            <template v-if="isEdit">
                <input
                    type="text"
                    class="font-nunito ml-3 px-4 rounded-md w-full focus:outline-none focus:border focus:border-blue-500"
                    v-model="todoForm.task"
                />
            </template>
            <template v-else>
                <p class="ml-3 leading-8">{{ todoForm.task }}</p>
            </template>
        </div>
        <template v-if="isEdit">
            <button type="button" @click="updateTaskTitle">
                <CheckIcon class="h-6 w-6 text-green-500" />
            </button>
        </template>
        <template v-else>
            <div class="flex flex-row justify-center items-center">
                <button type="button" @click="editTodo" class="mr-2">
                    <PencilIcon class="h-4 w-4 text-blue-500" />
                </button>
                <button type="button" @click="deleteTodo">
                    <XMarkIcon class="h-6 w-6 text-red-500" />
                </button>
            </div>
        </template>
    </div>
</template>

<script setup>
import { XMarkIcon, PencilIcon, CheckIcon } from "@heroicons/vue/24/solid";

import { useForm } from "@inertiajs/vue3";
import { ref, defineProps } from "vue";

// This time store a reference to props so we can pull in the defaults in the form
const props = defineProps(["todo", "todoPriorities"]);
const isEdit = ref(false);

// Populate form defaults based on the prop data
const todoForm = useForm({
    task: props.todo.task,
    priority: props.todo.priority,
    is_done: props.todo.is_done,
});

// Send an update request for the todo
const updateTaskDone = () => {
    todoForm.put(`/todos/${props.todo.id}/status`);
};

const updateTaskTitle = () => {
    todoForm.put(`/todos/${props.todo.id}/task`);
    isEdit.value = !isEdit.value;
};

const editTodo = () => {
    isEdit.value = !isEdit.value;
};

const updatePriority = () => {
    todoForm.put(`/todos/${props.todo.id}/priority`);
};

const deleteTodo = () => {
    todoForm.delete(`/todos/${props.todo.id}`);
};
</script>
