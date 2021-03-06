import React, { Component } from 'react';
import {
    StyleSheet,
    Text,
    View,
    FlatList, TextInput, TouchableOpacity,
    RefreshControl, Image, KeyboardAvoidingView
} from 'react-native';

export default class Feedback extends Component{
    static navigationOptions= ({navigation}) =>({
        title: 'Feedback',
        headerRight: <View />,
    });

    state={
        data:[],
        Con_ID:'',
        Content:'',
        Time:'',
        refreshing: false,
    };

    fetchData = async() =>{
        const {params} = this.props.navigation.state;
        const response =  await fetch('https://infs3202-17f1ea70.uqcloud.net/app/feedback.php',{
            method:'post',
            header:{
                'Accept': 'application/json',
                'Content-type': 'application/json'
            },
            body:JSON.stringify({
                ID: params.id,
            })
        })
        const products = await response.json(); // products have array data
        this.setState({data: products}); // filled data with dynamic array
    };

    componentDidMount() {
        this.fetchData();
    }

    _onRefresh(){
        this.setState({refreshing: true});
        this.fetchData().then(()=>{
            this.setState({refreshing: false})
        });
    }

    comment = () =>{
        const {Content} = this.state;
        const {params} = this.props.navigation.state;
        fetch('https://infs3202-17f1ea70.uqcloud.net/app/ifeedback.php', {
            method: 'post',
            header:{
                'Accept': 'application/json',
                'Content-type': 'application/json'
            },
            body:JSON.stringify({
                con_id: params.id,
                content: Content,
                time: Date(),
                ID: params.user_id,
            })
        })
            .then((response) => response.json())
            .then((responseJson) =>{
                alert(responseJson);
            })
            .catch((error)=>{
                console.error(error);
            });
    }

    render(){
        return(
            <KeyboardAvoidingView style={styles.MainContainer} behavior="padding">
                <View style={{flex: 1}}>
                    <FlatList
                        data={this.state.data}
                        keyExtractor={(x,i) => i.toString()}
                        ItemSeparatorComponent={ () =>  <View style={{height: 1, width: '100%', backgroundColor: 'black',}} /> }
                        renderItem={({item}) =>
                            <View style={{flex:1, flexDirection: 'row', marginBottom:10, marginTop:10,}}>
                                <Image style={{width:50, height:50, margin:5, marginRight:15}}
                                       source={require('../img/photo_per.png')} />
                                <View style={{flex:1, justifyContent: 'center', }}>
                                    <Text style={{fontSize: 14, color: '#0364F8', fontWeight: 'bold',}}>
                                        {item.username}
                                    </Text>
                                    <Text style={{fontSize: 10, marginBottom:10}}>
                                        Time: {item.Feedback_Time}
                                    </Text>
                                    <Text style={{fontSize: 16, }}>
                                        {item.Feedback_Content}
                                    </Text>
                                </View>
                            </View>
                        }
                        refreshControl={
                            <RefreshControl
                                refreshing={this.state.refreshing}
                                onRefresh={this._onRefresh.bind(this)}
                            />
                        }
                    />
                </View>

                <View style={{height: 1, width: '100%', backgroundColor: 'black', marginTop:10, }} />

                <View style={{flexDirection: 'row', marginTop:10,}}>
                    <Image style={{width:50, height:50, margin:5,marginRight:15}}
                           source={require('../img/photo_per.png')} />
                    <TextInput underlineColorAndroid='transparent' style={styles.input}
                               onChangeText={(Content) => this.setState({Content})}
                               numberOfLines={2}
                               multiline={true}
                               placeholder='Comment'
                               value={null}
                    />
                </View>
                <TouchableOpacity onPress={this.comment} style={styles.buttonContainer}>
                    <Text style={styles.buttonText}>Submit</Text>
                </TouchableOpacity>
            </KeyboardAvoidingView>
        );
    }
}

const styles = StyleSheet.create({
    MainContainer :{
        flex:1,
    },
    input: {
        width:'75%',
        fontSize: 16,
        height: 80,
        padding: 10,
        marginBottom: 10,
        backgroundColor: 'rgba(255,255,255,1)',
    },
    buttonContainer: {
        alignSelf: 'stretch',
        margin: 10,
        padding: 10,
        borderWidth: 1,
        borderColor: '#FFF',
        backgroundColor: '#rgba(255,255,255,1)',
    },
    buttonText: {
        fontSize: 14,
        fontWeight: 'bold',
        textAlign: 'center',
    },
});