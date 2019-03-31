import React from 'react';
import {StyleSheet, Text, View, ImageBackground, TextInput, TouchableOpacity} from 'react-native';

export default class Signup extends React.Component {
    static navigationOptions= ({navigation}) =>({
        header: null,
    });

    constructor(props){
        super(props)
        this.state={
            userName:'',
            userEmail:'',
            userPassword:''
        }
    }

    userRegister = () =>{
        const {userName} = this.state;
        const {userEmail} = this.state;
        const {userPassword} = this.state;

        fetch('https://infs3202-17f1ea70.uqcloud.net/app/register.php', {
            method: 'post',
            header:{
                'Accept': 'application/json',
                'Content-type': 'application/json'
            },
            body:JSON.stringify({
                name: userName,
                email: userEmail,
                password: userPassword,
            })
        })
            .then((response) => response.json())
            .then((responseJson) =>{
                alert(responseJson);
                if(responseJson == "User Registered Successfully") {
                    this.props.navigation.navigate("Login");
                }
            })
            .catch((error)=>{
                console.error(error);
            });

    }

    render() {
        return (
            <View style={styles.container}>
                <ImageBackground source={require('../img/background.jpg')} style={styles.backgroundImage}>
                    <View style={styles.content}>
                        <Text style={styles.logo}>ConferenceHub</Text>
                        <View style={styles.inputContainer}>
                            <Text style={styles.login}>Sign Up</Text>
                            <TextInput underlineColorAndroid='transparent' style={styles.input}
                                       onChangeText={(userName) => this.setState({userName})}
                                       value = {this.state.userName} placeholder='Enter Name'>
                            </TextInput>

                            <TextInput underlineColorAndroid='transparent' style={styles.input}
                                       onChangeText={(userEmail) => this.setState({userEmail})}
                                       value = {this.state.userEmail} placeholder='Enter Email'>
                            </TextInput>

                            <TextInput underlineColorAndroid='transparent' secureTextEntry={true} style={styles.input}
                                       onChangeText={(userPassword) => this.setState({userPassword})}
                                       value = {this.state.userPassword} placeholder='Enter Password'>
                            </TextInput>

                            <TouchableOpacity onPress={this.userRegister} style={styles.buttonContainer}>
                                <Text style={styles.buttonText}>Sign Up</Text>
                            </TouchableOpacity>
                        </View>
                        <TouchableOpacity
                            onPress={() => this.props.navigation.navigate('Login')}
                            style={styles.signUpContainer}>
                            <Text style={styles.signUpText}>Have signed up?</Text>
                            <Text style={styles.signUpText}>Login</Text>
                        </TouchableOpacity>
                    </View>
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
        marginBottom: 30,
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
        marginTop: 10,
    }
});