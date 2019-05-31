<template>
    <el-row >

        <el-col :span="24">
            <el-breadcrumb separator-class="el-icon-arrow-right">
                <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                <el-breadcrumb-item>修改商品库</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>

        <el-col :span="10" class="block">
        <el-form ref="form" :model="form" :rules="rules"  label-width="80px">
            <el-form-item label="名称" prop="goods_name">
                <el-input v-model="form.goods_name"></el-input>
            </el-form-item>
            <el-form-item label="售价"  prop="goods_price">
                <el-input-number controls-position="right" v-model="form.goods_price"></el-input-number>
            </el-form-item>
            <el-form-item label="重量"  prop="weight">
                <el-input v-model="form.weight"></el-input>
            </el-form-item>
            <el-form-item label="包装"  prop="packaging">
                <el-input v-model="form.packaging"></el-input>
            </el-form-item>
            <el-form-item label="图片">
                <el-upload
                        ref="upload"
                        :action="uploadurl"
                        :data="filesubdata"
                        list-type="picture-card"
                        :on-preview="handlePictureCardPreview"
                        :before-remove="handleRemove"
                        :multiple="true"
                        :headers="headers"
                        :on-success="onsuccess"
                        :on-error="errorIm"
                        :file-list="fileList"
                        >
                    <i class="el-icon-plus"></i>
                </el-upload>
                <el-dialog :visible.sync="dialogVisible" size="tiny">
                    <img width="100%" :src="dialogImageUrl" alt="">
                </el-dialog>
            </el-form-item>
            <el-form-item label="商品描述">
                <el-input type="textarea" v-model="form.desc"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('form')">修改</el-button>
                <el-button @click="resetForm('form')">重置</el-button>
            </el-form-item>
        </el-form>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        data() {
            return {
                dialogImageUrl: '',
                dialogVisible: false,
                uploadUrl:'',
                uploadImgList:[],
                id:'',
                fileList:[],
                form: {
                    goods_name: '',
                    goods_price: '',
                    weight: '',
                    packaging: '',
                    desc: '',
                },rules: {
                    goods_name: [
                    { required: true, message: '请输入名字', trigger: 'blur' },
                    { min: 2, max: 15, message: '长度在 2 到 15 个字符', trigger: 'blur' }
                    ],
                    weight: [
                    { required: true, message: '请输入商品重量', trigger: 'blur' }
                    ],
                    packaging: [
                        { required: true, message: '请输入商品包装', trigger: 'blur' }
                    ],
                    goods_price:[
                        {required:true,message:'请设置价格'},
                        {type:'number',message:'必须是数字'}
                    ]
                }
            }
        },
        created:function(){
            this.setForm()
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                       this.submitformsen(this.form);
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },submitformsen(formdata){
                let this_=this;
                console.log(this.uploadImgList);
                axios.post(this.suburl,formdata).then(function (response) {
                    if(response.status=='200'){
                        this_.id=response.data.id;
                        this_.filetodbajax();
                    }
                }).catch(function (error) {
                    console.log(error)
                })
            }, async handleRemove(file, fileList) {
              let da= await this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                  axios.post("/delete/file/"+file.id).then(function(response){

                  }).catch(function (err) {
                      console.log(err);
                  })
                    this.$message({
                        type: 'success',
                        message: '删除成功!'
                    });

                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                     reject('shibai')
                });

            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            },onsuccess(response, file, fileList){
                this.uploadImgList.push(response);
            },filetodbajax(){
                let data={
                    'id':this.id,
                    'type':'goods_storage',
                    'fileList':this.uploadImgList
                }
                axios.post(this.filetodb,data).then(function (response) {
                    if(response.status=='201'){
                        window.location.href="/goods/list";
                    }
                }).catch(function (error) {
                    console.log(error)
                })
            },errorIm(err, file, fileList){
                this.$notify.error({
                    title: '错误',
                    message: '文件上传失败'
                });
            },setForm(){
                let this_=this;
                axios.get(this.goodinfo).then(function (response) {
                    if(response.status=='200'){

                        this_.form=response.data.data
                        for(let item of response.data.images){
                            this_.fileList.push({'name':item.file_path,'url':this_.images_path+'storage/'+item.file_path,'id':item.id})
                        }
                    }
                }).catch(function (error) {
                    console.log(error)
                })
            }


        },
        props:['suburl','uploadurl','csrfToken','filetodb','goodinfo','images_path'],
        computed:{
            headers(){
                return {
                    'X-CSRF-TOKEN':this.csrfToken
                }
            },
            filesubdata(){
                return {
                    'type':'goods_storage'
                }
            }
        }
    }
</script>

<style scoped>
    .block{
        border: 1px solid #ebebeb;
        border-radius: 3px;
        transition: .2s;
        padding:20px;
        padding-right: 40px;
        margin-top: 20px;
    }
    .alert_sy{
        margin-top: 15px;
    }
</style>
