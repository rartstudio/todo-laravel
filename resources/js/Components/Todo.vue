<template>
    <div
        class="bg-gray-100 py-2 px-4 rounded flex flex-row justify-between items-center space-x-4"
    >
        <div class="flex flex-row">
            <select
                @change="updatePriority"
                class="font-nunito block px-2 py-1.5 bg-gray-100 rounded"
                v-model="todoForm.priority"
            >
                <option
                    v-for="(priority, index) in todoPriorities"
                    :key="index"
                    :value="priority"
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
const props = defineProps(["todo", "todoPriorities"]);

// Populate form defaults based on the prop data
const todoForm = useForm({
    task: props.todo.task,
    priority: props.todo.priority,
    is_done: props.todo.is_done,
});

// Send an update request for the todo
const updateTaskDone = () => {
    todoForm.put(`/todos/${props.todo.id}`);
};

const updatePriority = () => {
    todoForm.put(`/todos/${props.todo.id}`);
};

const deleteTodo = () => {
    todoForm.delete(`/todos/${props.todo.id}`);
};
</script>
