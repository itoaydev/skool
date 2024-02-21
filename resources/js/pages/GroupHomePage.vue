<template>
  <section class="w-full dark:bg-dark h-full p-5">
    <div class="max-w-6xl mx-auto">
      <div class="mb-4">
        <ul
          class="flex flex-wrap -mb-px"
          id="myTab"
          data-tabs-toggle="#myTabContent"
          role="tablist"
        >
          <li class="mr-2" role="presentation">
            <button
              class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300"
              id="community-tab"
              data-tabs-target="#community"
              type="button"
              role="tab"
              aria-controls="community"
              aria-selected="false"
            >
              Community
            </button>
          </li>
          <li class="mr-2" role="presentation">
            <button
              class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300 active"
              id="classroom-tab"
              data-tabs-target="#classroom"
              type="button"
              role="tab"
              aria-controls="classroom"
              aria-selected="false"
            >
              Classroom
            </button>
          </li>
          <li class="mr-2" role="presentation">
            <button
              class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300"
              id="calendar-tab"
              data-tabs-target="#calendar"
              type="button"
              role="tab"
              aria-controls="calendar"
              aria-selected="false"
            >
              Calendar
            </button>
          </li>
          <li role="presentation">
            <button
              class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300"
              id="member-tab"
              data-tabs-target="#member"
              type="button"
              role="tab"
              aria-controls="member"
              aria-selected="false"
            >
              Members
            </button>
          </li>
        </ul>
      </div>
      <div id="myTabContent">
        <div
          class="hidden"
          id="community"
          role="tabpanel"
          aria-labelledby="community-tab"
        >
       
            <Community></Community>
       
        </div>
        <div
          class=""
          id="classroom"
          role="tabpanel"
          aria-labelledby="classroom-tab"
        >
          <Classroom :userData="userData"></Classroom>
        </div>
        <div
          class="bg-gray-50 p-4 rounded-lg dark:bg-gray-800 hidden"
          id="calendar"
          role="tabpanel"
          aria-labelledby="calendar-tab"
        >
          <p class="text-gray-500 dark:text-gray-400 text-sm">
            Calendar
          </p>
        </div>
        <div
          class="bg-gray-50 p-4 rounded-lg dark:bg-gray-800 hidden"
          id="member"
          role="tabpanel"
          aria-labelledby="member-tab"
        >
          <p class="text-gray-500 dark:text-gray-400 text-sm">
           Members
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import Community from "../pages/Community";
import Classroom from "../pages/Classroom";
import { ref } from "vue";
import { onMounted } from "vue";
import { initFlowbite, initDropdowns } from "flowbite";
const user = ref([]);
const userData = ref([]);

onMounted(() => {
  initFlowbite();
  initDropdowns();
});

onMounted(() => {
  axios
    .get("/api/v1/me")
    .then((response) => {
      user.value = response.data.data;
      fetchUserData(user.value.id);
    })
    .catch((error) => console.log(error));
});

async function fetchUserData(userID) {
  try {
    const res = await axios.get(`/api/users/${userID}`);
    userData.value = res.data;
  } catch (error) {
    console.log(error);
  }
}
</script>

<style></style>
