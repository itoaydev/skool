<template>
  <div
    class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20"
  >
    <div class="flex flex-col md:justify-center lg:flex-row">
      <div
        class="flex flex-col justify-between p-5 border-b sm:p-10 lg:border-b-0 lg:border-r lg:w-1/2"
      >
        <div>
          <h5
            class="max-w-md mb-6 text-3xl font-extrabold leading-none sm:text-4xl"
          >
            <router-link to="/" class="fw-bold">Skool</router-link>
          </h5>
          <p
            class="font-semibold mb-6 text-base text-gray-700 md:text-lg sm:mb-8"
          >
            Everything you need to build community and make money online.
          </p>
          <div class="mt-5 font-semibold leading-10 text-lg">
            <h5 class="mb-3">📈 Highly engaged</h5>
            <h5 class="mb-3">🖤 Simple to set up</h5>
            <h5 class="mb-3">🙂 Fun to use</h5>
            <h5 class="mb-3">💰 Charge for membership</h5>
            <h5 class="mb-3">📱 iOS + Android apps</h5>
            <h5 class="mb-3">🌎 Millions of users daily</h5>
          </div>
        </div>
      </div>
      <div
        class="flex flex-col justify-between p-5 sm:p-10 lg:w-1/2 bg-white rounded-lg shadow-sm"
      >
        <div class="card-body m-3">
          <div class="card-text text-center mb-5">
            <h4 class="font-bold text-2xl">Create your community</h4>
          </div>
          <form>
            <div class="flex justify-center">
              <img
                :src="groupImage ? groupImage : 'https://dummyimage.com/600x360'"
                alt=""
                class="rounded h-52 p-5"
                @click="openFileInput"
              />
            </div>
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
            </div>
            <div class="mb-5">
              <label
                for="group_name"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Group Name</label
              >
              <input
                type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                id="group_name"
                name="group_name"
                placeholder="Group Name"
                v-model="group.group_name"
              />
              <small class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ errors.group_name }}
              </small>
            </div>
            <div class="mb-5">
              <label
                for="group_email"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Email Address</label
              >
              <input
                type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                id="group_email"
                name="group_email"
                placeholder="name@email.com"
                v-model="group.email"
              />
              <small class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ errors.email }}
              </small>
            </div>
            <div class="mb-3">
              <label
                for="message"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Group Description</label
              >
              <textarea
                id="group_description"
                rows="5"
                name="group_description"
                placeholder="Description"
                v-model="group.group_description"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              ></textarea>
              <small class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ errors.group_description }}
              </small>
            </div>
            <button
              v-show="!isLoading"
              @click="handleSubmit()"
              type="button"
              class="text-black/80 bg-[#f1d07c] focus:ring-0 rounded-lg me-2 mb-2 border w-full py-2 font-bold tracking-wide mt-3"
            >
              CREATE GROUP
            </button>

            <button
              v-show="isLoading"
              disabled
              type="button"
              class="text-black/80 bg-[#f1d07c] rounded-lg me-2 mb-2 border w-full py-2 font-bold tracking-wide mt-3"
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
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const userData = ref({ type: "admin" });
const user = ref([]);
const groupImage = ref(null);
const fileInput = ref(null);
const isLoading = ref(false);

const group = ref({
  group_name: "",
  group_description: "",
  email: "",
});

const errors = ref({
  group_name: "",
  group_description: "",
  email: "",
});

const fetchCurrentUser = async () => {
  try {
    const response = await axios.get("/api/v1/me");
    user.value = response.data.data;
  } catch (error) {
    console.log(error);
  }
};

const openFileInput = () => fileInput.value.click();

const handleFileChange = (event) => {
  const file = event.target.files[0];
  groupImage.value = URL.createObjectURL(file);
  group.value.group_picture = file;
};

const handleSubmit = async () => {
  try {
    let isValid = true;

    const validateInput = (field, minLength, maxLength, errorMessage) => {
      if (
        group.value[field].length > minLength &&
        group.value[field].length < maxLength
      ) {
        errors.value[field] = "";
      } else {
        errors.value[field] = errorMessage;
        isValid = false;
      }
    };

    validateInput("group_name", 0, 50, "Please Input Group Name");
    validateInput(
      "group_description",
      0,
      1000,
      "Please Input Group Description"
    );
    validateInput("email", 0, 50, "Please Input Email");

    if (isValid) {
      isLoading.value = true;
      const formData = new FormData();
      formData.append("group[group_name]", group.value.group_name);
      formData.append(
        "group[group_description]",
        group.value.group_description
      );
      formData.append("group[email]", group.value.email);
      formData.append("group_picture", group.value.group_picture);
      formData.append("group[creator_id]", user.value.id);

      const response = await axios.post("api/group/store", formData, {
        headers: { "Content-Type": "multipart/form-data" },
      });

      if (user.value.id) {
        await axios.put(`api/users/${user.value.id}/updateType`, userData.value);
      }
      router.push(`/group-home-page/${response.data.id}`);
    }
  } catch (error) {
    alert(error);
    console.log(error);
    isLoading.value = false;
  }
};

onMounted(fetchCurrentUser);
</script>
<style></style>
