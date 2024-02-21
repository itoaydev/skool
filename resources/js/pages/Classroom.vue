<template>
  <main>
    <section class="text-gray-600 body-font">
      <div class="container px-5 mx-auto">
        <!-- Modal toggle -->
        <button
          data-modal-target="course-modal"
          data-modal-toggle="course-modal"
          class="block text-black bg-[#f8d48199] hover:bg-[#f8d48199] focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
          type="button"
          v-if="userData?.type == 'admin'"
        >
          Add Course
        </button>
        <div class="flex flex-wrap -m-4 mt-3">
          <div v-for="course in courses" :key="course.id" class="p-4 md:w-1/3">
            <div class="h-full shadow-sm bg-white rounded-lg overflow-hidden">
              <img
                class="lg:h-48 md:h-36 w-full object-cover object-center"
                :src="`/storage/${course.course_image}`"
                alt="blog"
              />
              <div class="p-6">
                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                  {{ course.course_name }}
                </h1>
                <p class="leading-relaxed mb-3">
                  {{ course.course_description }}
                </p>
                <div class="flex flex-col w-full max-w-xs gap-y-5 pt-7">
                  <button
                    class="font-semibold bg-white flex items-center text-gray-400 dark:text-gray-300 justify-center gap-x-3 text-sm sm:text-base dark:bg-gray-900 dark:border-gray-700 dark:hover:bg-gray-800 rounded-lg hover:bg-gray-100 duration-300 transition-colors border px-8 py-2.5"
                  >
                    <span>OPEN</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Add Course modal -->
      <div
        id="course-modal"
        tabindex="-1"
        aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
      >
        <div class="relative p-4 w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
              class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
            >
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Add Course
              </h3>
              <button
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="course-modal"
              >
                <svg
                  class="w-3 h-3"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 14 14"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                  />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
              <div class="flex justify-center">
                <img
                  :src="
                    courseImage ? courseImage : 'https://dummyimage.com/600x360'
                  "
                  alt=""
                  class="rounded-3xl h-52 p-5"
                  @click="openFileInput"
                />
              </div>
              <div>
                <label
                  for="group_name"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Course Image</label
                >

                <div class="mb-3">
                  <input
                    type="file"
                    class="form-control block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="image"
                    name="image"
                    aria-label="Upload"
                    ref="fileInput"
                    @change="handleFileChange"
                  />
                  <small class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ errors.course_image }}
                  </small>
                </div>
              </div>
              <div class="mb-6">
                <label
                  for="course_name"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Course Name</label
                >
                <input
                  type="text"
                  id="course_name"
                  name="course_name"
                  v-model="courseData.course_name"
                  placeholder="Course Name"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
                <small class="mt-2 text-sm text-red-600 dark:text-red-500">
                  {{ errors.course_name }}
                </small>
              </div>
              <div class="mb-5">
                <label
                  for="course_description"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Course Description</label
                >
                <textarea
                  id="course_description"
                  name="course_description"
                  v-model="courseData.course_description"
                  rows="4"
                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Write your description here..."
                ></textarea>
                <small class="mt-2 text-sm text-red-600 dark:text-red-500">
                  {{ errors.course_description }}
                </small>
              </div>
              <button
                v-show="!isLoading"
                @click="createCourse"
                type="submit"
                class="text-black bg-[#f8d48199] hover:bg-[#f8d48199] focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
              >
                ADD
              </button>
              <button
                v-show="isLoading"
                disabled
                type="button"
                class="text-black bg-[#f8d48199] hover:bg-[#f8d48199] focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
              >
                <svg
                  aria-hidden="true"
                  role="status"
                  class="inline w-4 h-4 me-3 text-black/80 animate-spin"
                  viewBox="0 0 100 101"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="#E5E7EB"
                  />
                  <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentColor"
                  />
                </svg>
                LOADING...
              </button>
              <button
                data-modal-hide="course-modal"
                type="button"
                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
              >
                CANCEL
              </button>
            </div>
            <!-- Modal footer -->
          </div>
        </div>
      </div>
    </section>
  </main>
</template>
<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { defineProps } from "vue";
const courseImage = ref(null);
const router = useRouter();
const courses = ref([]);
const fileInput = ref(null);
const isLoading = ref(false);

const props = defineProps({
  userData: Object,
});

const courseData = ref({
  course_name: "",
  course_description: "",
  course_image: "",
  group_id: router.currentRoute.value.params.id,
});

const errors = ref({
  course_name: "",
  course_description: "",
  course_image: "",
});

const openFileInput = () => fileInput.value.click();
const handleFileChange = (event) => {
  const file = event.target.files[0];
  courseImage.value = URL.createObjectURL(file);
  courseData.value.course_image = file;
};

const createCourse = () => {
  let isValid = true;
  if (courseData.value.course_name == "") {
    errors.value.course_name = "Please Input Name";
    isValid = false;
  }
  if (courseData.value.course_description == "") {
    errors.value.course_description = "Please Input Description";
    isValid = false;
  }
  if (courseData.value.course_image == "") {
    errors.value.course_image = "Image is Required";
    isValid = false;
  }

  if (isValid) {
    isLoading.value = true;
    const formData = new FormData();
    formData.append("course_name", courseData.value.course_name);
    formData.append("course_description", courseData.value.course_description);
    formData.append("course_image", courseData.value.course_image);
    formData.append("group_id", courseData.value.group_id);

    axios
      .post("/api/course", formData)
      .then((response) => {
        courses.value.push(response.data.course);
        courseData.value = {
          course_name: "",
          course_description: "",
          course_image: "",
        };
        errors.value = {
          course_name: "",
          course_description: "",
          course_image: "",
        };
        courseImage.value = null;
        document.getElementById("image").value = "";
        isLoading.value = false;
      })
      .catch((error) => {
        console.error("Error creating course:", error);
      });
  }
};

const getCourse = () => {
  axios
    .get(`/api/getCourse/${courseData.value.group_id}`)
    .then((res) => (courses.value = res.data))
    .catch((error) => console.log(error));
};

onMounted(() => getCourse());
</script>

<style></style>
