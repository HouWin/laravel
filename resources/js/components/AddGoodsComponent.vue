<template>
    <el-row >

        <el-col :span="24">
            <el-breadcrumb separator-class="el-icon-arrow-right">
                <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                <el-breadcrumb-item>新增商品库{{uploadurl}}</el-breadcrumb-item>
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
                        :on-remove="handleRemove"
                        :auto-upload="false"
                        :headers="headers"
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
                <el-button type="primary" @click="submitForm('form')">立即创建</el-button>
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
                id:'',
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
                axios.post(this.suburl,formdata).then(function (response) {
                    if(response.status=='201'){
                        this_.id=response.data.id;
                        this_.$refs.upload.submit();
                    }
                }).catch(function (error) {
                    console.log(error)
                })
            },handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            }


        },
        props:['suburl','uploadurl','csrfToken'],
        computed:{
            headers(){
                return {
                    'X-CSRF-TOKEN':this.csrfToken
                }
            },
            filesubdata(){
                return {
                    'id':this.id,
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
