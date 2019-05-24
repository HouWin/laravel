<template>
    <el-row >

        <el-col :span="24">
            <el-breadcrumb separator-class="el-icon-arrow-right">
                <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                <el-breadcrumb-item>我的店</el-breadcrumb-item>
                <el-breadcrumb-item>创建店铺</el-breadcrumb-item>
            </el-breadcrumb>
        </el-col>
        <el-row >
        <el-col :span="10">
            <el-alert
                    class="alert_sy"
                    title="检测到您还没有店铺，现在将新建您的超市"
                    type="info"
                    center
                    show-icon>
            </el-alert>
        </el-col>
        </el-row>
        <el-col :span="10" class="block">
        <el-form ref="form" :model="form" :rules="rules"  label-width="80px">
            <el-form-item label="名称" prop="shop_name">
                <el-input v-model="form.shop_name"></el-input>
            </el-form-item>
            <el-form-item label="手机号"  prop="tel">
                <el-input v-model="form.tel"></el-input>
            </el-form-item>
            <el-form-item label="小区"  prop="community">
                <el-input v-model="form.community"></el-input>
            </el-form-item>
            <el-form-item label="详细地址"  prop="site">
                <el-input v-model="form.site"></el-input>
            </el-form-item>
            <el-form-item label="开放时间"  >
                <el-col :span="10">
                    <el-form-item  prop="business_hours_start">
                        <el-time-select
                                placeholder="起始时间"
                                v-model="form.business_hours_start"
                                :picker-options="{
                                start: '00:00',
                              step: '00:30',
                              end: '10:00'
                          }">
                        </el-time-select>
                    </el-form-item>
                </el-col>
                <el-col :span="10">
                    <el-form-item  prop="business_hours_end">
                        <el-time-select
                                placeholder="结束时间"
                                v-model="form.business_hours_end"
                                :picker-options="{
      start: '00:00',
      step: '00:30',
      end: '24:00',
      minTime: form.business_hours_start
    }">
                        </el-time-select>
                    </el-form-item>
                </el-col>
            </el-form-item>
            <el-form-item label="即时配送">
                <el-switch v-model="form.timely"></el-switch>
            </el-form-item>
            <el-form-item label="起送价格" prop="up_to_send">
            <el-input-number v-model="form.up_to_send" :min="1" :max="100" ></el-input-number>
            </el-form-item>
            <el-form-item label="超市介绍">
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
                form: {
                    shop_name: '',
                    community: '',
                    site: '',
                    business_hours_start: '',
                    business_hours_end:'',
                    timely: false,
                    desc: '',
                    tel:'',
                    up_to_send:'',
                },rules: {
                    shop_name: [
                    { required: true, message: '请输入名字', trigger: 'blur' },
                    { min: 2, max: 15, message: '长度在 2 到 15 个字符', trigger: 'blur' }
                    ],
                    community:[
                        { required: true, message: '请输入小区名称', trigger: 'blur' },
                        { min: 2, max: 15, message: '长度在 2 到 15 个字符', trigger: 'blur' }
                    ],
                    site: [
                    { required: true, message: '请输入地址', trigger: 'blur' }
                    ],
                    tel: [
                        { required: true, message: '请输入电话或手机号', trigger: 'blur' }
                    ],
                    business_hours_start: [
                    { required: true, message: '请选择开始时间' }
                    ],
                    business_hours_end: [
                    {  required: true, message: '请选择结束时间' }
                    ],
                    up_to_send:[
                        {required:true,message:'请设置起送价格'},
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
                axios.post(this.suburl,formdata).then(function (response) {
                    if(response.data.code=='200'){

                        window.location.href="/myShop"
                    }
                }).catch(function (error) {
                    console.log(error)
                })
            }
        },
        props:['suburl','myshop']
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
