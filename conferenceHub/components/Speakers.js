import React, { Component } from 'react';
import {
    StyleSheet,
    Text,
    View,
    FlatList, ActivityIndicator, Image,
} from 'react-native';

export default class Speakers extends Component{
    static navigationOptions= ({navigation}) =>({
        title: 'Speakers',
        headerRight: <View />,
    });

    state={
        data:[],
        isLoading: true,
    };

    fetchData = async() =>{
        const {params} = this.props.navigation.state;
        const response =  await fetch('https://infs3202-17f1ea70.uqcloud.net/app/speakers.php',{
            method:'post',
            header:{
                'Accept': 'application/json',
                'Content-type': 'application/json'
            },
            body:JSON.stringify({
                ID: params.id,
            })
        });
        const products = await response.json(); // products have array data
        this.setState({data: products,
            isLoading:false}); // filled data with dynamic array
    };

    componentDidMount() {
        this.fetchData();
    }

    render(){
        if (this.state.isLoading) {
            return (
                <View style={{flex:1, justifyContent:'center', alignItems:'center'}}>
                    <ActivityIndicator size='large' color='#330066' animating/>
                </View>
            );
        }

        return(
            <View style={styles.MainContainer}>
                <FlatList
                    data={this.state.data}
                    keyExtractor={(x,i) => i.toString()}
                    ItemSeparatorComponent={ () =>  <View style={{height: 1, width: '100%', backgroundColor: 'black', }} /> }
                    renderItem={({item}) =>
                        <View style={{flex:1, flexDirection: 'row', marginTop:10, marginBottom:10, marginRight:10}}>
                            <Image style={{width:50, height:50, margin:5, marginRight:15,}}
                                   source={require('../img/photo_per.png')} />
                            <View style={{flex:1, justifyContent: 'center', }}>
                                <Text style={{fontSize: 16, color: '#0364F8', fontWeight: 'bold',}}>
                                    {item.Speakers_Name}
                                </Text>
                                <Text style={{fontSize: 12, marginBottom:10, fontStyle:'italic', }}>
                                    {item.Speakers_Description}
                                </Text>
                                <Text style={{fontSize: 12, marginBottom:10,}}>
                                    <Text style={{fontWeight:'bold',}}>Company:</Text> {item.Speakers_Company}
                                </Text>
                                <Text style={{fontSize: 12,}}>
                                    <Text style={{fontWeight:'bold',}}>Email:</Text> {item.Speakers_Email}
                                </Text>
                            </View>
                        </View>
                    }
                />
            </View>
        );
    }
}

const styles = StyleSheet.create({
    MainContainer :{
        flex:1,
    },
});