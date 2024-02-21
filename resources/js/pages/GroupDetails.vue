<template>
  <main>
    <div class="md:container md:mx-auto">
      <section class="text-gray-600 body-font px-[150px]">
        <div class="px-5 py-6">
          <nav class="flex" aria-label="Breadcrumb">
            <ol
              class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
            >
              <li class="inline-flex items-center">
                <router-link
                to="/"
                  class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#ffce5b99] dark:text-gray-400 dark:hover:text-white"
                >
                  <svg
                    class="w-3 h-3 me-2.5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"
                    />
                  </svg>
                  Home
                </router-link>
              </li>
              <li aria-current="page">
                <div class="flex items-center">
                  <svg
                    class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 6 10"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="m1 9 4-4-4-4"
                    />
                  </svg>
                  <span
                    class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"
                    >Group Details</span
                  >
                </div>
              </li>
            </ol>
          </nav>
        </div>
        <div
          class="container mx-auto flex px-5 py-8 md:flex-row flex-col gap-5"
        >
          <div
            class="px-6 py-3 lg:flex-grow md:w-1/2 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center bg-white rounded-lg shadow-sm dark:bg-gray-800"
          >
            <h1
              class="title-font sm:text-2xl text-2xl mb-5 font-medium text-gray-900"
            >
              {{ group.group_name }}
            </h1>
            <div class="rounded-lg h-64 overflow-hidden mb-5 w-full">
              <img
                alt="content"
                class="object-cover object-center h-full w-screen"
                :src="`/storage/${group.group_picture}`"
              />
            </div>
            <div
              class="flex lg:flex-row md:flex-col gap-3 font-semibold items-center"
            >
              <p>Private Group</p>
              <p>7.7K Members</p>
              <p>Free</p>
              <div class="flex items-center gap-3">
                <img
                  class="hidden object-cover w-8 h-8 rounded-full sm:block"
                  :src="`/storage/${creatorName.image}`"
                  alt="avatar"
                />
                <p>By {{ creatorName.name }}</p>
              </div>
            </div>
            <p class="mt-8 leading-relaxed">
              {{ group.group_description }}
            </p>
          </div>
          <div class="lg:max-w-lg lg:w-1/3 md:w-1/2 w-5/6">
            <div
              class="w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800"
            >
              <img
                class="object-cover object-center w-full h-56"
                :src="`/storage/${group.group_picture}`"
                alt="avatar"
              />

              <div class="px-6 py-4">
                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                  {{ group.group_name }}
                </h1>

                <p class="py-2 text-gray-700 dark:text-gray-400">
                  Full Stack maker & UI / UX Designer , love hip hop music
                  Author of Building UI.
                </p>

                <div class="flex items-center font-semibold">
                  <div class="flex items-center gap-10">
                    <p
                      class="text-gray-700 dark:text-gray-200"
                      tabindex="0"
                      role="link"
                    >
                      Members
                    </p>
                    <p
                      class="text-gray-700 dark:text-gray-200"
                      tabindex="0"
                      role="link"
                    >
                      Online
                    </p>
                    <p
                      class="text-gray-700 dark:text-gray-200"
                      tabindex="0"
                      role="link"
                    >
                      Admin
                    </p>
                  </div>
                </div>
                <div class="flex flex-col w-full max-w-xs gap-y-5 pt-7">
                  <button
                    class="bg-white flex items-center text-gray-700 dark:text-gray-300 justify-center gap-x-3 text-sm sm:text-base dark:bg-gray-900 dark:border-gray-700 dark:hover:bg-gray-800 rounded-lg hover:bg-gray-100 duration-300 transition-colors border px-8 py-2.5"
                  >
                    <span>JOIN GROUP</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const group = ref({});
const groupId = ref(null);

const creatorName = ref({});

onMounted(() => {
  groupId.value = router.currentRoute.value.params.id;
  axios
    .get(`/api/group/${groupId.value}/show`)
    .then((res) => {
      group.value = res.data;
      fetchCreatorName(group.value.creator_id);
    })
    .catch((error) => console.log(error));
});

async function fetchCreatorName(creatorId) {
  try {
    const res = await axios.get(`/api/users/${creatorId}`);
    creatorName.value = res.data;
  } catch (error) {
    console.log(error);
  }
}
</script>
<style></style>
