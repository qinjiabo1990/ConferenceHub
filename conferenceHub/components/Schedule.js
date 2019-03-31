import React, { Component } from 'react';
import {
    StyleSheet,
    Text,
    View,
    FlatList, ActivityIndicator
} from 'react-native';
import ScheduleAdd from './ScheduleAdd';
import CheckBox from "react-native-check-box";

export default class Schedule extends Component{
    static navigationOptions= ({navigation}) =>({
        title: 'Activities',
        headerRight: <View />,
    });

    state={
        data:[],
        isLoading: true,
    };

    fetchData = async() =>{
        const {params} = this.props.navigation.state;
        const response =  await fetch('https://infs3202-17f1ea70.uqcloud.net/app/schedule.php',{
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
                    ItemSeparatorComponent={ () =>  <View style={{height: 2, width: '100%', backgroundColor: 'black'}} /> }
                    renderItem={({item}) =>
                        <View style={{flex:1, flexDirection: 'column'}}>
                            <View style={{flex:1, justifyContent: 'center', margin:10,}}>
                                <Text style={{fontSize: 20, marginBottom: 0, fontWeight: 'bold'}}>
                                    {item.Schedule_Title}
                                </Text>
                                <View style={{height: 1, width: '80%',  marginBottom: 10,}} />
                                <Text style={{fontSize: 15, marginBottom: 10, fontStyle:'italic', color: '#515151'}}>
                                    {item.Schedule_Description}
                                </Text>
                                <View style={{height: 1, width: '80%', marginBottom: 10,}} />
                                <Text style={{fontSize: 13, marginBottom: 10,}}>
                                    <Text style={{fontWeight:'bold',}}>Venue:</Text> {item.Schedule_Location}
                                </Text>

                                <Text style={{fontSize: 13, marginBottom: 10, }}>
                                    <Text style={{fontWeight:'bold',}}>Start Time:</Text> {item.Schedule_StartTime}
                                </Text>
                                <Text style={{fontSize: 13, marginBottom: 10, }}>
                                    <Text style={{fontWeight:'bold',}}>End Time:</Text> {item.Schedule_EndTime}
                                </Text>
                                <View style={{height: 1, width: '80%', marginBottom: 10,}} />
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