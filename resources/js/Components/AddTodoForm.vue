<template>
    <form
        @submit.prevent="createTodo"
        class="font-nunito border flex space-x-4 p-4 rounded"
    >
        <div class="flex-1">
            <input
                class="font-nunito block px-2 py-1.5 bg-gray-100 rounded w-full focus:outline-none focus:border focus:border-blue-500"
                placeholder="Enter your task..."
                type="text"
                v-model="todoForm.task"
            />
            <small
                v-if="todoForm.errors['task']"
                class="text-red-500 mt-2 block font-nunito"
            >
                {{ todoForm.errors["task"] }}
            </small>
        </div>
        <div>
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
                >
                    {{ priority }}
                </option>
            </select>
        </div>
        <div>
            <button
                class="font-nunito px-6 py-1.5 bg-indigo-600 rounded text-white disabled:opacity-50"
                :disabled="todoForm.processing"
            >
                <PlusIcon class="h-6 w-6 text-white" />
            </button>
        </div>
    </form>
</template>

<script setup>
// Import hero icon
import { PlusIcon } from "@heroicons/vue/24/solid";

// Import the useForm helper
import { useForm } from "@inertiajs/vue3";

// store props
const props = defineProps(["todoPriorities"]);

// Initialise the form with the properties we want to update client-side send to the server-side
const todoForm = useForm({
    processing: false,
    task: "",
    priority: 0,
});

// Create a method that tells the form to submit to TodoController@store
const createTodo = () => {
    todoForm.processing = true;
    todoForm.post("/todos");
    todoForm.reset();
};
</script>
