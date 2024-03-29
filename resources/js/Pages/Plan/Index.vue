<script setup>
import {Head} from '@inertiajs/vue3';
import {onBeforeMount, ref} from "vue";

const props = defineProps({
    plans: {
        type: Array,
        default: []
    }
})

const activeDeveloper = ref(props.plans[0]);
const activeWeekIndex = ref(0);
const activeWeek = ref(null);

const toggleDeveloper = (id) => {
    const developer = props.plans.find(developer => developer.id === id);
    if (developer) {
        activeDeveloper.value = developer;

        toggleWeek(0);
    }
}

const toggleWeek = (index) => {
    activeWeek.value = activeDeveloper.value.weeks[index];
    activeWeekIndex.value = index;
}

onBeforeMount(() => {
    toggleWeek(0);
})
</script>

<template>
    <Head title="Tasks"/>

    <div class="sm:px-6 w-full">
        <div class="px-4 md:px-10 py-4 md:py-7">
            <div class="flex items-center justify-between">
                <p tabindex="0"
                   class="focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800">
                    Tasks</p>
            </div>
        </div>
        <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
            <div class="flex items-center gap-2">
                <button v-for="plan in plans" @click="toggleDeveloper(plan.id)"
                        class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 px-8 py-2"
                        :class="{
                            'bg-indigo-100 text-indigo-700' : activeDeveloper.id === plan.id,
                            'bg-gray-100 text-gray-700' : activeDeveloper.id !== plan.id,
                        }">
                    <p class="text-sm font-bold">{{ plan.name }}</p>
                    <p class="text-xs font-light">Max Workload: {{ plan.workload }}</p>
                </button>
            </div>
            <div class="mt-7 overflow-x-auto">
                <div class="flex items-center gap-2 m-2">
                    <button v-for="(week, index) in activeDeveloper.weeks" @click="toggleWeek(index)"
                            class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 px-8 py-2"
                            :class="{
                            'bg-indigo-100 text-indigo-700' : activeWeekIndex === index,
                            'bg-gray-100 text-gray-700' : activeWeekIndex !== index,
                        }">
                        <p class="text-sm font-bold">{{ index + 1 }}. Week</p>
                        <p class="text-xs font-light">{{ week.workload }} Workload</p>
                    </button>
                </div>
                <table class="w-full whitespace-nowrap">
                    <thead class="py-2">
                    <tr class="focus:outline-none h-16 border border-gray-100 rounded">
                        <th class="pl-5 text-sm leading-none text-gray-600 ml-2 font-bold">ID</th>
                        <th class="pl-5 text-sm leading-none text-gray-600 ml-2 font-bold">Task Name</th>
                        <th class="pl-5 text-sm leading-none text-gray-600 ml-2 font-bold">Workload</th>
                        <th class="pl-5 text-sm leading-none text-gray-600 ml-2 font-bold">Rollover</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="task in activeWeek.tasks"
                        class="text-center focus:outline-none h-16 border border-gray-100 rounded">
                        <td class="pl-5">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ task?.id }}</p>
                        </td>
                        <td class="pl-5">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ task?.name }}</p>
                        </td>
                        <td class="pl-5">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ task?.workload }}</p>
                        </td>
                        <td class="pl-5">
                            <p class="text-sm leading-none ml-2"
                               :class="{
                                'text-emerald-600 font-bold' : task.rollover,
                                'text-gray-600' : !task.rollover
                               }"
                            >
                                {{ task?.rollover }}
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style scoped>
.checkbox:checked + .check-icon {
    display: flex;
}
</style>
