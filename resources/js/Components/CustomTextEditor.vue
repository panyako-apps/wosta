<template>
    <div>
      <ckeditor :editor="customEditor" v-model="editorData" :config="editorConfig"></ckeditor>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { component as CKEditor } from '@ckeditor/ckeditor5-vue';
//   import CustomEditor from '../ckeditor/ckeditor.js'; // Adjust the path based on your project structure
import * as ClassicEditor from '/resources/js/ckeditor/ckeditor.js';

  // Data
  const customEditor = ref(null);
  const editorData = ref('');
  const editorConfig = {
    // Add your configuration options here
  };
  
  // Lifecycle hook
  onMounted(() => {
    // Initialize the custom editor
    customEditor.value = CustomEditor.create(document.querySelector('#editor'))
      .then(editor => {
        // Do something with the editor instance
        console.log('Custom Editor created', editor);
      })
      .catch(error => {
        console.error('Error creating the custom editor', error);
      });
  });
  </script>
  
  <style scoped>
  /* Add your custom styling here */
  </style>
  