<template>
    <el-row>
        <el-col :span="6" :offset="9" class="login_box">
            <el-card>
            <el-form :model="ruleForm2" status-icon :rules="rules2" ref="ruleForm2" label-width="100px" v-bind:action="submitUrl" class="demo-ruleForm">
                <el-form-item label="用户名" prop="username">
                    <el-input  v-model="ruleForm2.username" ></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="password">
                    <el-input type="password" v-model="ruleForm2.password" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="" prop="remember">
                    <el-checkbox label="Remember Me " name="remember"></el-checkbox>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submitForm('ruleForm2')">登录</el-button>
                    <el-button type="text"><a v-bind:href="forget">忘记密码?</a></el-button>
                    <!--<el-button @click="resetForm('ruleForm2')">重置</el-button>-->
                </el-form-item>
            </el-form>
        </el-card>
        </el-col>
    </el-row>
</template>
<script>
    export default {
        data() {
            var checkAge = (rule, value, callback) => {
                if (!value) {
                    return callback(new Error('此处不能为空哦'));
                }
                callback();
            };

            return {
                ruleForm2: {
                    username: '',
                    password: '',
                    remember: ''
                },
                rules2: {
                    username: [
                        { validator: checkAge, trigger: 'blur' }
                    ],
                    password: [
                        { validator: checkAge, trigger: 'blur' }
                    ],
                },
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.postFormData();
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },postFormData(){
                let formData=new FormData();
                formData.append('email',this.ruleForm2.username);
                formData.append('password',this.ruleForm2.password);
                formData.append('remember',this.ruleForm2.remember);
                axios.post(
                    this.submitUrl,
                    formData).then((response) =>{
                    console.log(response.data)
                }).catch((error)=>{
                    if (error.response) {
                        let err=error.response.data.errors;
                        this.$message.error('用户名或者密码错误！');
                    }
                    console.log(error);
                })
            }

        },
        props:['forget','submitUrl']
    }
</script>

<style scoped>

  .demo-ruleForm{
      padding: 20px;
      padding-left: 0px;
      padding-right: 40px;
      padding-top: 30px;
  }
    .login_box{ margin-top:15%;}
</style>