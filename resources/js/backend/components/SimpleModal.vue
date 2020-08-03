<template>
  <transition name="modal">
    <div class="modal-mask" :v-show="show" @click="close">
      <div class="modal-container">
        <div
          class="modal"
          tabindex="-1"
          role="dialog"
          aria-labelledby="Modal"
          style="display: block"
        >
          <div class="modal-dialog modal-sm" role="document" @click.stop>
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">{{title}}</h5>
                <button type="button" class="close" aria-label="Close" @click="close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-left" v-html="body"></div>
              <div class="modal-footer">
                <button
                  type="button"
                  :class="submitButtonClass"
                  @click="submit"
                >{{submitButtonText}}</button>
                <button type="button" :class="cancelButtonClass" @click="close">{{cancelButtonText}}</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-backdrop show"></div>
      </div>
    </div>
  </transition>
</template>

<script type="text/babel">
export default {
  name: "simplemodal",
  props: {
    show: { type: Boolean, required: true },
    title: {
      type: String,
      default: "Modal :title",
    },
    body: {
      type: String,
      default: "Modal :body",
    },
    submitButtonText: {
      type: String,
      required: false,
      default: "Cancle",
    },
    submitButtonClass: {
      type: String,
      required: false,
      default: "btn btn-danger mr-auto",
    },
    cancelButtonText: {
      type: String,
      required: false,
      default: "Cancle",
    },
    cancelButtonClass: {
      type: String,
      required: false,
      default: "btn btn-default",
    },
  },
  methods: {
    close() {
      this.$emit("closeModal");
    },
    submit() {
      this.$emit("onSubmit", {
        status: "success",
        message: "Foru submited" /* Or optional success message */,
      });
    },
  },
};
</script>


<style lang="scss" scoped>
* {
  box-sizing: border-box;
}

.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  transition: opacity 0.3s ease;
}
/* .alert-warning {
  color: #856404 !important;
  background-color: #fff3cd !important;
  border-color: #ffeeba !important;
} */
.alert {
  position: relative;
  padding: 0.75rem 1.25rem;
  margin-bottom: 1rem;
  border: 1px solid transparent;
  border-radius: 0.25rem;
}
@media (min-width: 768px) {
  .modal-dialog {
    max-width: 600px;
    margin: 1.75rem auto;
  }
  .modal-dialog-centered {
    min-height: calc(100% - (1.75rem * 2));
  }
  .modal-sm {
    max-width: 300px;
  }
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

/* .modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
} */
</style>
