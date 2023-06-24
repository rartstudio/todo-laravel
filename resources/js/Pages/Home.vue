<template>
    <div class="mx-auto max-w-5xl mt-10 px-4">
        <h1 class="font-nunito font-light text-3xl">My Todo List</h1>

        <div class="flex flex-col space-y-4 mt-5">
            <AddTodoForm :todo-priorities="todoPriorities" />
            <Todo
                v-for="todo in todos"
                :key="todo.id"
                :todo="todo"
                :todo-priorities="todoPriorities"
            />
        </div>
        <div class="flex justify-center mt-4">
            <ul class="flex flex-row space-x-2">
                <li
                    v-for="(pagination, index) in separatedPaginationRef"
                    :key="index"
                >
                    <Link
                        class="px-4 py-2 bg-green-500 rounded-md"
                        :href="pagination[Object.keys(pagination)[0]]"
                        >{{ Object.keys(pagination)[0] }}</Link
                    >
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import Todo from "../Components/Todo.vue";
import { ref } from "vue";
import AddTodoForm from "../Components/AddTodoForm.vue";

const { todos, todoPriorities, todoPagination } = defineProps([
    "todos",
    "todoPriorities",
    "todoPagination",
]);

// convert {'1': 'url', '2': 'url'} to {'1':'url'},{'2': 'url'}
const separatedPagination = Object.entries(todoPagination[0]).map(
    ([key, value]) => ({
        [key]: value,
    })
);

const separatedPaginationRef = ref(separatedPagination);
</script>
