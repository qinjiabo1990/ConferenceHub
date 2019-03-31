import React, { Component } from 'react';
import {
    StyleSheet,
    Text,
    View,
    Image, FlatList, ActivityIndicator,
} from 'react-native';
import Icon from 'react-native-vector-icons/SimpleLineIcons';

import ConferenceHome from './ConferenceHome';
import {createStackNavigator} from "react-navigation";
import Schedule from './Schedule';
import Attendees from './Attendees';
import Feedback from './Feedback';
import Exhibitors from './Exhibitors';
import Location from './Location';
import Speakers from './Speakers';
import Info from './Info';
import Clicker from './Clicker';
import Sponsors from './Sponsors';
import ScheduleAdd from './ScheduleAdd';

export default class Homelist extends Component{
    static navigationOptions= ({navigation}) =>({
        headerTitle: 'Conference List',
        headerRight:
            <Icon.Button name="logout" size={14} onPress={() => navigation.goBack(null)}>
                Logout
            </Icon.Button>
    });

    state={
        data:[],
        dataUser:[],
        isLoading: true,
    };

    //Fetch conference data
    fetchData = async() =>{
        const response =  await fetch('https://infs3202-17f1ea70.uqcloud.net/app/conferenceList.php');
        const products = await response.json(); // products have array data
        this.setState({
            data: products,
            isLoading: false}); // filled data with dynamic array
    };

    //Fetch user information data
    fetchDataUser = async() =>{
        const {params} = this.props.navigation.state;
        const response =  await fetch('https://infs3202-17f1ea70.uqcloud.net/app/account.php',{
            method:'post',
            header:{
                'Accept': 'application/json',
                'Content-type': 'application/json'
            },
            body:JSON.stringify({
                email: params.user,
            })
        });
        const products = await response.json(); // products have array data
        this.setState({dataUser: products,
            isLoading: false}); // filled data with dynamic array
    };

    componentDidMount() {
        this.fetchData();
        this.fetchDataUser();
    }

    render(){
        const {navigate} = this.props.navigation;
        if (this.state.isLoading) {
            return (
                <View style={{flex:1, justifyContent:'center', alignItems:'center'}}>
                    <ActivityIndicator size='large' color='#330066' animating/>
                </View>
            );
        }
        return(
            <View style={styles.MainContainer}>
                {
                    this.state.dataUser.map((value, key) =>
                        <FlatList
                            data={this.state.data}
                            key={key}
                            keyExtractor={(x,i) => i.toString()}
                            ItemSeparatorComponent={ () =>  <View style={{height: 1, width: '100%',
                                backgroundColor: 'black', marginBottom:5, marginTop:10}} /> }
                            renderItem={({item}) =>
                                <View style={{flex:1, flexDirection: 'row', marginTop:10,}}>
                                    <Image style={{width:100, height:100, margin:5,}}
                                           source={{uri: item.Con_Image}} />
                                    <View style={{flex:1, justifyContent: 'center', }}>
                                        <Text style={{fontSize: 18, marginBottom: 5, fontWeight: 'bold'}}>
                                            {item.Con_Name}
                                        </Text>
                                        <Text style={{fontSize: 13, marginBottom: 10, fontStyle:'italic'}}>
                                            {item.Con_Abstract}
                                        </Text>
                                        <Text style={{fontSize: 13, marginBottom: 5, }}>
                                            Location: {item.Con_Address}
                                        </Text>
                                        <Text style={{fontSize: 13, marginBottom: 5, }}>
                                            Date: {item.Con_Date}
                                        </Text>
                                        <View style={{marginBottom: 5, width:'30%',}}>
                                            <Icon.Button name="plus" size={14}
                                                         onPress={() => navigate("ConferenceHome", {id: item.Con_ID,
                                                             user_id:value.id, user_name:value.username,})}>
                                                Entry
                                            </Icon.Button>
                                        </View>
                                    </View>
                                </View>
                            }
                        />
                    )}
            </View>
        );
    }
}

const styles = StyleSheet.create({
    MainContainer :{
        flex:1,
    },
});

export const HomelistStack = createStackNavigator({
    Homelist: {
        screen: Homelist,
    },
    ConferenceHome: {
        screen: ConferenceHome,
    },
    Schedule: {
        screen: Schedule,
    },
    Attendees: {
        screen: Attendees,
    },
    Feedback: {
        screen: Feedback,
    },
    Exhibitors: {
        screen: Exhibitors,
    },
    Location: {
        screen: Location,
    },
    Speakers: {
        screen: Speakers,
    },
    Info: {
        screen: Info,
    },
    Clicker: {
        screen: Clicker,
    },
    Sponsors: {
        screen: Sponsors,
    },
    ScheduleAdd: {
        screen: ScheduleAdd,
    },
});