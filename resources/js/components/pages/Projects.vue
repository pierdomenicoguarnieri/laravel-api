<script>
import ProjectCard from '../partials/ProjectCard.vue';
import Pagination from '../partials/Pagination.vue';
import axios from 'axios';
import {store} from '../../data/store';

export default {
  name: 'Main',

  components: {
    ProjectCard,
    Pagination
  },

  data(){
    return{
      store,
      projects: [],
      results: [],
      types: [],
      technologies: [],
      projectToSearch: ''
    }
  },

  methods:{
    getApi(url){
      axios.get(url).then(results => {
        this.projects = results.data.data;
        this.results = results.data;
        this.projectToSearch = '';
      })
    },

    getTypes(endpoint){
      axios.get(endpoint).then(results => {
        this.types = results.data;
      })
    },

    getTechnologies(endpoint){
      axios.get(endpoint).then(results => {
        this.technologies = results.data;
      })
    },
  },

  mounted(){
    this.projects = []
    this.getApi(store.apiUrl)
    this.getTypes(store.apiUrlTypes)
    this.getTechnologies(store.apiUrlTechnologies)
  }
}
</script>

<template>
  <h1>Lista dei progetti</h1>

  <div class="pg-filter-wrapper d-flex">
    <div class="pg-right">
      <h5>Filtro per tipo:</h5>
      <button class="btn btn-outline-light me-2 mb-2" @click="getApi(store.apiUrl + 'get-by-type/' + type.id)" v-for="type in types" :key="type.id">{{ type.name }}</button>
      <button class="btn btn-outline-danger me-2 mb-2" @click="getApi(store.apiUrl)">Reset</button>
    </div>

    <div class="pg-center">
      <h5>Filtro per tecnologia:</h5>
      <button
        class="btn btn-outline-light me-2 mb-2"
        @click="getApi(store.apiUrl + 'get-by-technology/' + technology.id)"
        v-for="technology in technologies"
        :key="technology.id">{{ technology.name }}</button>
      <button class="btn btn-outline-danger me-2 mb-2" @click="getApi(store.apiUrl)">Reset</button>
    </div>

    <div class="pg-left w-50">
      <h5>Cerca un progetto:</h5>
      <div class="input-group mb-3">
        <input type="text" class="form-control bg-transparent text-white" v-model="projectToSearch" @keyup.enter="getApi(store.apiUrl + 'search/' + projectToSearch)">
        <button class="btn btn-outline-light" type="button" id="button-addon2" @click="getApi(store.apiUrl + 'search/' + projectToSearch)">Cerca</button>
      </div>
    </div>
  </div>

  <div class="row row-cols-5 mt-2">
    <ProjectCard
      v-for="project in projects"
      :key="project.id"
      :project="project"/>
    </div>
    <Pagination
      :links="results.links"
      :current_page="results.current_page"
      @callApi="(url) => getApi(url)" />
</template>

<style lang="scss" scoped>
  button{
    font-size: 0.8rem;
  }
</style>