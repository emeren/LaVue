<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daty</h3>

      <div class="card-tools">
        <button
          type="button"
          class="btn btn-tool"
          data-card-widget="collapse"
          data-toggle="tooltip"
          title="Collapse"
        >
          <i class="fas fa-calendar"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="inputEstimatedBudget">Data publikacji</label>
        <input
          type="text"
          id="inputEstimatedDuration"
          class="form-control"
          v-model="postData.publish_from"
          step="0.1"
        />
      </div>
      <div class="form-group">
        <label for="inputSpentBudget">Zakończ publikacje</label>
        <input
          type="text"
          id="inputEstimatedDuration"
          class="form-control"
          v-model="postData.publish_to"
          step="0.1"
        />
      </div>
      <div class="form-group" v-if="postData">
        <label for="inputEstimatedDuration">Utworzono</label>
        <input
          type="text"
          id="inputEstimatedDuration"
          class="form-control"
          v-model="postData.created_at"
          step="0.1"
        />
      </div>
    </div>
    <!-- /.card-body -->
  </div>
</template>

<script>
export default {
  props: {
    postData: {
      required: true
    }
  }
};
</script>

<style lang="scss" scoped></style>
