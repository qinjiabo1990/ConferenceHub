import React, { Component } from 'react';
import {
    StyleSheet,
    Text,
    View,
    FlatList, Image,
} from 'react-native';

export default class Info extends Component{
    static navigationOptions= ({navigation}) =>({
        title: 'Information',
        headerRight: <View />,
    });

    state={
        data:[],
    };

    fetchData = async() =>{
        const {params} = this.props.navigation.state;
        const response =  await fetch('https://infs3202-17f1ea70.uqcloud.net/app/other_info.php',{
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
        this.setState({data: products}); // filled data with dynamic array
    };

    componentDidMount() {
        this.fetchData();
    }

    render(){
//justifyContent: 'center'(up or down)
        return(
            <View style={styles.MainContainer}>
                {
                    this.state.data.map((item, key) =>
                        <View key={key} style={{flex:1, flexDirection: 'column'}}>
                            <View style={{alignItems:'center', marginBottom:20, marginTop:20}}>
                                <Image style={{width:50, height:50,}}
                                       source={require('../img/photo_info.png')} />
                                <Text style={{fontSize:22, marginTop:15,}}>
                                    {item.Con_Name}
                                </Text>
                            </View>

                            <View style={{height: 1, width: '100%', backgroundColor: 'black', marginBottom:15,}} />

                            <View style={{flex:1, marginLeft: 10,}}>
                                <Text style={{fontSize: 18, marginBottom: 20, fontWeight: 'bold',}}>
                                    Location Information:
                                </Text>
                                <Text style={{fontSize: 16, marginBottom: 10, }}>
                                    <Text style={{fontWeight:'bold',}}>Venue: </Text>{item.Info_Location}
                                </Text>
                                <Text style={{fontSize: 16, marginBottom: 10, }}>
                                    <Text style={{fontWeight:'bold',}}>Address: </Text>{item.Info_Address}
                                </Text>
                                <View style={{height: 1, width: '80%', backgroundColor: 'black', marginBottom:15,}} />

                                <Text style={{fontSize: 18, fontWeight: 'bold',marginBottom: 20,}}>
                                    WIFI:
                                </Text>
                                <Text style={{fontSize: 16, marginBottom: 10,}}>
                                    {item.Info_WIFI}
                                </Text>
                                <View style={{height: 1, width: '80%', backgroundColor: 'black', marginBottom:15,}} />
                                <Text style={{fontSize: 18, fontWeight: 'bold',marginBottom: 20,}}>
                                    Other Information:
                                </Text>
                                <Text style={{fontSize: 16, marginBottom: 10,}}>
                                    {item.Info_Other}
                                </Text>
                            </View>
                        </View>
                    )
                }
            </View>
        );
    }
}

const styles = StyleSheet.create({
    MainContainer :{
        flex:1,
    },
});