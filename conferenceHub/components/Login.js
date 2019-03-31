import React, { Component } from 'react';
import {
    AppRegistry,
    StyleSheet,
    Text,
    View, TouchableOpacity, TextInput, AsyncStorage, ImageBackground, KeyboardAvoidingView
} from 'react-native';
import {HomelistStack} from './Homelist';

export default class Login extends Component {
    static navigationOptions= ({navigation}) =>({
        header: null,
    });

    constructor(props){
        super(props)
        this.state={
            userEmail:'',
            userPassword:''
        }
    }

    login = () =>{
        const {userEmail,userPassword} = this.state;
        let reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
        if(userEmail==""){
            //alert("Please enter Email address");
            this.setState({email:'Please enter Email address'})
        }

        else if(reg.test(userEmail) === false)
        {
            this.setState({email:'Email is Not Correct'})
            return false;
        }

        else if(userPassword==""){
            this.setState({email:'Please enter password'})
        }

        else{
            fetch('https://infs3202-17f1ea70.uqcloud.net/app/login.php',{
                method:'post',
                header:{
                    'Accept': 'application/json',
                    'Content-type': 'application/json'
                },
                body:JSON.stringify({
                    // we will pass our input data to server
                    email: userEmail,
                    password: userPassword
                })
            })
                .then((response) => response.json())
                .then((responseJson)=>{
                    if(responseJson == "ok"){
                        AsyncStorage.setItem('email', userEmail); //set the userEmail here.
                        this.props.navigation.navigate("HomelistStack", {user: userEmail});///////
                    }else{
                        alert("Wrong Login Details");
                    }
                })
                .catch((error)=>{
                    console.error(error);
                });
        }
    }

    render() {
        return (
            <View style={styles.container}>
                <ImageBackground source={require('../img/background.jpg')} style={styles.backgroundImage}>
                    <KeyboardAvoidingView style={styles.content} behavior="padding">
                        <Text style={styles.logo}>ConferenceHub</Text>
                        <View style={styles.inputContainer}>
                            <Text style={styles.login}>Login</Text>
                            <Text style={{padding:10,margin:10,color:'red'}}>{this.state.email}</Text>
                            <TextInput
                                underlineColorAndroid='transparent'
                                style={styles.input}
                                placeholder="Enter Email"
                                onChangeText={userEmail => this.setState({userEmail})}
                                value = {this.state.userEmail}
                            />

                            <TextInput
                                underlineColorAndroid='transparent'
                                secureTextEntry={true}
                                style={styles.input}
                                placeholder="Enter Password"
                                onChangeText={userPassword => this.setState({userPassword})}
                                value = {this.state.userPassword}
                            />

                            <TouchableOpacity
                                onPress={this.login}
                                style={styles.buttonContainer}>
                                <Text style={styles.buttonText}>Login</Text>
                            </TouchableOpacity>
                        </View>
                        <TouchableOpacity
                            onPress={() => this.props.navigation.navigate('Signup')}
                            style={styles.signUpContainer}>
                            <Text style={styles.signUpText}>Please sign up here</Text>
                        </TouchableOpacity>
                    </KeyboardAvoidingView>
                </ImageBackground>
            </View>

        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
    },
    backgroundImage: {
        flex: 1,
        alignSelf: 'stretch',
        width: null,
        justifyContent: 'center',//up or down
    },
    content: {
        alignItems : 'center',//left or right
    },
    logo: {
        color: 'white',
        fontSize: 40,
        fontStyle: 'italic',
        fontWeight: 'bold',
        textShadowColor: '#252525',
        textShadowOffset: {width: 2, height: 2},
        textShadowRadius: 15,
        marginBottom: 20,
    },
    login:{
        color: 'black',
        fontSize: 25,
        fontWeight: 'bold',
        textAlign: 'center',
    },
    inputContainer: {
        margin: 20,
        marginBottom: 0,
        padding: 20,
        paddingBottom: 10,
        alignSelf: 'stretch',
        borderWidth: 1,
        borderColor: '#fff',
        backgroundColor: 'rgba(255,255,255,0.2)',
    },
    input: {
        fontSize: 16,
        height: 40,
        padding: 10,
        marginBottom: 10,
        backgroundColor: 'rgba(255,255,255,1)',
    },
    buttonContainer: {
        alignSelf: 'stretch',
        margin: 20,
        padding: 20,
        borderWidth: 1,
        borderColor: '#fff',
        backgroundColor: 'rgba(255,255,255,0.6)',
    },
    buttonText: {
        fontSize: 16,
        fontWeight: 'bold',
        textAlign: 'center',
    },
    signUpContainer:{
        marginTop: 20,
        alignSelf: 'stretch',
    },
    signUpText:{
        fontSize: 18,
        fontWeight: 'bold',
        textAlign: 'center',
        textDecorationLine: 'underline',
    }
});

AppRegistry.registerComponent('login', () => login);