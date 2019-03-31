import React, { Component } from 'react';
import {
    StyleSheet,
    Text,
    View,
    FlatList, TouchableOpacity,
    RefreshControl, Image,
} from 'react-native';

export default class Attendees extends Component{
    static navigationOptions= ({navigation}) =>({
        title: 'Attendees',
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
        const response =  await fetch('https://infs3202-17f1ea70.uqcloud.net/app/attendees.php',{
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

    join = () =>{
        const {params} = this.props.navigation.state;
        fetch('https://infs3202-17f1ea70.uqcloud.net/app/attendees_join.php', {
            method: 'post',
            header:{
                'Accept': 'application/json',
                'Content-type': 'application/json'
            },
            body:JSON.stringify({
                con_id: params.id,
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
            <View style={styles.MainContainer}>
                <View style={{flex: 1}}>
                    <FlatList
                        data={this.state.data}
                        keyExtractor={(x,i) => i.toString()}
                        ItemSeparatorComponent={ () =>  <View style={{height: 1, width: '100%', backgroundColor: 'black'}} /> }
                        renderItem={({item}) =>
                            <View style={{flex:1, flexDirection: 'row'}}>
                                <Image style={{width:50, height:50, margin:5,marginRight:15}}
                                       source={require('../img/photo_per.png')} />
                                <View style={{flex:1, justifyContent: 'center', }}>
                                    <Text style={{fontSize: 14, marginBottom: 5}}>
                                        {item.username}
                                    </Text>
                                    <Text style={{fontSize: 14, }}>
                                        Email: {item.email}
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
                <TouchableOpacity onPress={this.join} style={styles.buttonContainer}>
                    <Text style={styles.buttonText}>Join the conference</Text>
                </TouchableOpacity>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    MainContainer :{
        flex:1,
    },
    input: {
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
        borderColor: '#fff',
        backgroundColor: 'rgba(255,255,255,0.6)',
    },
    buttonText: {
        fontSize: 14,
        fontWeight: 'bold',
        textAlign: 'center',
    },
});
/*<View>
                <Text>{params.user_id}</Text>
                <Text>{params.user_name}</Text>
                <Text>{params.id}</Text>

            </View>
*/