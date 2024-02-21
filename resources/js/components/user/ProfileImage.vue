<template>
  <div>
    <div class="flex justify-center">
      <img
        :src="userImage ? userImage : `storage/${userData.image}`"
        alt=""
        class="rounded-full h-52 p-5"
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
    <div class="flex items-center justify-end mt-4">
      <button
        @click="handleUpdate"
        type="submit"
        class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3"
      >
        Update
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const fileInput = ref(null);
const userImage = ref(null);
const user = ref([]);
const userData = ref([]);

const fetchCurrentUser = async () => {
  try {
    const response = await axios.get("/api/v1/me");
    user.value = response.data.data;
    getUser();
  } catch (error) {
    console.log(error);
  }
};

const getUser = async () => {
  try {
    const response = await axios.get(`/api/users/${user.value.id}`);
    userData.value = response.data;
  } catch (error) {
    console.log(error);
  }
};

const openFileInput = () => fileInput.value.click();
const handleFileChange = (event) => {
  const file = event.target.files[0];
  userImage.value = URL.createObjectURL(file);
  user.value.image = file;
};

const handleUpdate = () => {
  const formData = new FormData();

  // Check if there's a file selected
  const imageFile = document.getElementById("image").files[0];
  if (imageFile) {
    formData.append("image", imageFile);
  }
  axios
    .post(`/api/users/${user.value.id}/update`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    })
    .then((response) => {
      userData.value = response.data;
      document.getElementById("image").value = "";
      alert('Successfully Updated')
    })
    .catch((error) => console.log(error));
};

onMounted(fetchCurrentUser);
</script>

<style></style>
