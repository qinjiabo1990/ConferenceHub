import React, { Component } from 'react';
import {StyleSheet, View, Image, TouchableHighlight, Linking} from 'react-native';
import Swiper from 'react-native-swiper';
import Speakers from './Speakers';
import Icon from 'react-native-vector-icons/SimpleLineIcons';

export default class ConferenceHome extends Component{
    static navigationOptions= ({navigation}) =>({
        title: "Conference Home",
        headerLeft: null,
        headerRight:
            <Icon.Button name="list" size={14} onPress={() => navigation.goBack(null)}>
                List
            </Icon.Button>
    });

    state={
        data:[],
    };

    fetchData = async() =>{
        const {params} = this.props.navigation.state;
        const response =  await fetch('https://infs3202-17f1ea70.uqcloud.net/app/conference.php',{
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
        const {params} = this.props.navigation.state;
        return(
            <View style={styles.overlayContainer}>
                {
                    this.state.data.map((item, key) =>
                        <Swiper style={styles.wrapper}
                                dot={<View style={{backgroundColor: '#87939a', width: 13, height: 13, borderRadius: 7, marginLeft: 7, marginRight: 7}} />}
                                activeDot={<View style={{backgroundColor: '#2b2b2b', width: 13, height: 13, borderRadius: 7, marginLeft: 7, marginRight: 7}} />}
                                paginationStyle={{
                                    bottom: 30
                                }}
                                key={key}
                                loop={false}>
                            <View style={styles.menuContainer}>
                                <TouchableHighlight style={styles.menuItem} onPress={() => this.props.navigation.navigate('Schedule', {id: item.Con_ID})}>
                                    <Image style={styles.image} source={require('../img/schedule.png')} />
                                </TouchableHighlight>
                                <TouchableHighlight style={styles.menuItem} onPress={() => this.props.navigation.navigate('Attendees', {id: item.Con_ID,
                                    user_id: params.user_id,
                                    user_name:params.user_name})}>
                                    <Image style={styles.image} source={require('../img/attendees.png')} />
                                </TouchableHighlight>
                                <TouchableHighlight style={styles.menuItem} onPress={() => this.props.navigation.navigate('Feedback', {id: item.Con_ID, user_id: params.user_id, user_name:params.user_name})}>
                                    <Image style={styles.image} source={require('../img/feedback.png')} />
                                </TouchableHighlight>
                                <TouchableHighlight style={styles.menuItem} onPress={() => this.props.navigation.navigate('Exhibitors', {id: item.Con_ID})}>
                                    <Image style={styles.image} source={require('../img/exhibitors.png')} />
                                </TouchableHighlight>
                                <TouchableHighlight style={styles.menuItem} onPress={() => this.props.navigation.navigate('Location', {id: item.Con_ID})}>
                                    <Image style={styles.image} source={require('../img/map.png')} />
                                </TouchableHighlight>
                                <TouchableHighlight style={styles.menuItem} onPress={() => this.props.navigation.navigate("Speakers", {id: item.Con_ID})}>
                                    <Image style={styles.image} source={require('../img/speakers.png')} />
                                </TouchableHighlight>
                                <TouchableHighlight style={styles.menuItem} onPress={() => this.props.navigation.navigate('Info', {id: item.Con_ID})}>
                                    <Image style={styles.image} source={require('../img/info.png')} />
                                </TouchableHighlight>
                                <TouchableHighlight style={styles.menuItem} onPress={() => this.props.navigation.navigate('Clicker')}>
                                    <Image style={styles.image} source={require('../img/clicker.png')} />
                                </TouchableHighlight>
                                <TouchableHighlight style={styles.menuItem} onPress={() => this.props.navigation.navigate('Sponsors', {id: item.Con_ID})}>
                                    <Image style={styles.image} source={require('../img/sponsors.png')} />
                                </TouchableHighlight>
                            </View>
                            <View style={styles.menuContainer}>
                                <TouchableHighlight style={styles.menuItem} onPress={()=>{ Linking.openURL('https://facebook.com')}}>
                                    <Image style={styles.image} source={require('../img/facebook.png')} />
                                </TouchableHighlight>
                                <TouchableHighlight style={styles.menuItem} onPress={()=>{ Linking.openURL('https://twitter.com')}}>
                                    <Image style={styles.image} source={require('../img/twitter.png')} />
                                </TouchableHighlight>
                                <TouchableHighlight style={styles.menuItem} onPress={()=>{ Linking.openURL('https://linkedin.com')}}>
                                    <Image style={styles.image} source={require('../img/linkedin.png')} />
                                </TouchableHighlight>
                            </View>
                        </Swiper>
                    )
                }
            </View>
        );
    }
}

const styles = StyleSheet.create({
    overlayContainer:{
        flex: 1,
        backgroundColor: '#fafafa',
    },
    menuContainer: {
        height: '35%',
        flexDirection: 'row',
        flexWrap: 'wrap',
    },
    menuItem: {
        width: '33.3333333333%',
        paddingTop: 0,
        height: '80%',
    },
    image: {
        width:'100%',
        height:'100%',
        opacity:0.8,
    },
});
/*for app "Linking.openURL('Facebook://app')" or for web page "Linking.openURL('https://facebook.com')"*/
