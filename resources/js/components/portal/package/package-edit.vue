<template>
  <form @submit.prevent="update" class="form" enctype="multipart/form-data">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <h5>Package Name:</h5>
            <input
              type="text"
              required
              v-model="packages.package_name"
              class="form-control form-control-solid"
              placeholder="Enter Package name"
            />
          </div>
          
          <div class="form-group">
            <h5>Featured Image</h5>
            <div class="input-group input-group-lg">
              <input
                type="file"
                ref="file"
                @change="handleFileUpload"
                class="form-control form-control-solid"
              />
              <img style="height:100px;" :src="packages.image_path" />
            </div>
          </div>

          <div class="form-group">
            <h5>Package Type:</h5>
            <select required v-model="packages.package_type"  class="form-control">
              <option v-for="(item,item_index) in packageType" :key="item_index" :value="item_index">{{item.replace('_' , ' ')}}</option>
            </select>
          </div>

          <div class="form-group">
            <h5>Package Speciality:</h5>
            <select required v-model="packages.product_type"  class="form-control">
              <option v-for="(item,item_index) in productType" :key="item_index" :value="item_index">{{item.replace('_' , ' ')}}</option>
            </select>
          </div>

          <div class="form-group">
            <h5>Select Hotels:</h5>
            <select
             multiple
              required
              v-model="packages.hotels"
              class="form-control" >
              <option
                v-for="(item, item_index) in hotels"
                :key="item_index"
                :value="item.id"  >
                {{ item.name }}
              </option>
            </select>
          </div>

          <div class="form-group">
            <h5>Select Transports:</h5>
            <select
            multiple
              required
              v-model="packages.transports"
              class="form-control"
            >
              <option
                v-for="(item, item_index) in transports"
                :key="item_index"
                :value="item.id">
                {{ item.company }}   {{ item.model }}
              </option>
            </select>
          </div>

          <div class="form-group">
            <h5>Nights</h5>
            <div class="input-group input-group-lg">
              <input
                type="number"
                required
                v-model="packages.nights"
                class="form-control form-control-solid"
              />
            </div>
          </div>

          <div class="form-group">
            <h5>Days</h5>
            <div class="input-group input-group-lg">
              <input
                type="number"
                required
                v-model="packages.days"
                class="form-control form-control-solid"
              />
            </div>
          </div>

            <div class="form-group">
            <h5>City</h5>
            <div class="input-group input-group-lg">
              <input
                type="text"
                required
                v-model="packages.city"
                class="form-control form-control-solid"
              />
            </div>
          </div>

          <div class="form-group">
            <h5>Seasonality</h5>
            <div class="input-group input-group-lg">
              <input
                type="text"
                required
                v-model="packages.seasonality"
                class="form-control form-control-solid"
              />
            </div>
          </div>
 

          <div class="form-group">
            <h5>Features</h5>
            <div class="">
              <quill-editor
                contentType="html"
                toolbar="full"
                v-model:content="packages.features"
                theme="snow"
              ></quill-editor>
            </div>
          </div>
 
          
          <div class="form-group">
            <h5>Description</h5>
            <div class="">
              <quill-editor
                contentType="html"
                toolbar="full"
                v-model:content="packages.description"
                theme="snow"
              ></quill-editor>
            </div>
          </div>
 
          
        </div>

        <div class="col-md-6">
         
          <div class="form-group">
            <h5>Traveling Start Date</h5>
            <div class="input-group input-group-lg">
              <input
                type="date"
                required
                v-model="packages.traveling_date_start"
                class="form-control form-control-solid"
              />
            </div>
          </div>

          <div class="form-group">
            <h5>Traveling End Date</h5>
            <div class="input-group input-group-lg">
              <input
                type="date"
                required
                v-model="packages.traveling_date_end"
                class="form-control form-control-solid"
              />
            </div>
          </div>

          <div class="form-group">
            <h5>Package Price</h5>
            <div class="input-group input-group-lg">
              <input
                type="number"
                required
                v-model="packages.package_price"
                class="form-control form-control-solid"
              />
            </div>
          </div>

          <div class="form-group">
            <h5>Package Discount</h5>
            <div class="input-group input-group-lg">
              <input
                type="number"
                required
                v-model="packages.discount"
            
                class="form-control form-control-solid"
              />
            </div>
          </div>

          <div class="form-group">
            <h5>Package Price After Discount</h5>
            <div class="input-group input-group-lg">
              <input
               style="border:1px solid red"
                  disabled
                type="number"
                :value="calculateTotalAmount"
                class="form-control form-control-solid"
              />
            </div>
          </div>


          <div class="form-group">
            <h5>Status:</h5>
            <select v-model="packages.status" class="form-control">
              <option value="1">Active</option>
              <option value="0">In Active</option>
            </select>
          </div>


        </div>

        <div class="col-md-12">
          <div class="panel-body"> 
           ADD NEW<i class="fa fa-plus pull-right"  @click="addRow" style="font-size:25px;color:#337ab7;cursor:pointer"></i>
            <table class="table table-bordered">
            <thead class="text text-success">
                <tr>                            
                    <th>Day</th>
                    <th>Detail</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                   <tr v-for='(itenary, index) in itenaries' :key="index">                            
                    <td>
                    <input  v-model="itenary.day"  class="form-control" type="text" />
                    </td>
                    <td>
                    <input v-model="itenary.detail" class="form-control" type="text" />
                    </td>
                   
                    <td>
                    <i  @click="deleteRow(index)" class="fa fa-remove" style="font-size:25px;color:red;cursor:pointer"></i>
                    </td>
                </tr>                        
        </tbody>
    </table>
        </div> 
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <h5>Package Images</h5>
            <div class="input-group input-group-lg">
             
              <update-media
                server="/package/uploadImage"
                media-file-path="/storage/uploads/package_images"
                :media-server="'/package/media/' + this.packages.id"
                @added-media="addedMedia"
                @deleted-media="deletedMedia"
                @saved-media="savedMedia"
              >
              </update-media>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary mr-2">Submit</button>
      <a href="/portal/package/" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</template>

<script>
import "@vueup/vue-quill/dist/vue-quill.snow.css";

export default {
  props:['packageData','packageType','productType','hotels','transports'],
  mounted() {
    console.log("Component mounted.");
    console.log(this.packageData.itenary);
    
  },

  data() {

    return {
      packages: this.packageData,
      packageImages: [],
      featured_image: '',
      deletedImages: [],
      addedImages: [],
      savedImages: [],
      itenaries: this.packageData.itenary == "null" ?  [{day:'',detail:''}]  : JSON.parse(this.packageData.itenary)    
    };
  },
  computed: {
    calculateTotalAmount : function(){
           let total =  this.packages.package_price - this.packages.discount ; 
          this.packages.net_amount=total ;
          return total;
          }
  },
  methods: {    

    handleFileUpload(event) {
        this.featured_image = event.target.files[0];
       console.log(event.target.files[0]);
   },

    addedMedia(images) {
      console.log("added media" + images);
      images.forEach((image) => {
        this.addedImages.push(image.name);
      });
    },
    deletedMedia(images) {
      console.log("deleted media" + images);
      images.forEach((image) => {
        this.deletedImages.push(image.name);
      });
    },
    savedMedia(images) {
      console.log("saved media" + images);
    },
    addRow: function() {      
       this.itenaries.push({day:'',detail:''})
    },
    deleteRow(index){    
        this.itenaries.splice(index,1);             
    },   
    update() {
      axios
        .post(
          `/package/${this.packages.id}`,
          {
            _method: "PUT",
            package: this.packages,
            itenaries : this.itenaries,
            featured_image :  this.featured_image,
            deletedImages: this.deletedImages,
            addedImages: this.addedImages,
          },
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
            _token: csrfToken,
          }
        )
        .then((response) => {
          if (response.data.success) {
            window.location.href = "/portal/package";
          }
        })
        .catch((err) => console.log(err))

        .finally(() => (this.loading = false));
    },
  },
};
</script>

